model.multaController = {

    multa: {
        id: ko.observable(null),
        causa_id: ko.observable(null),
        tipo_multa_id: ko.observable(null),
        linea_chofer_id: ko.observable(null),
        agente_id: ko.observable(null),
        fecha_multa: ko.observable(""),
        transporte_id: ko.observable(null),
        total_a_pagar: ko.observable(null),
        transporte: ko.observable(""),
        no_linea: ko.observable(""),
        observacion: ko.observable("")
    },

    multas: ko.observableArray([]),
    causas: ko.observableArray([]),
    tipos: ko.observableArray([]),
    pilotos: ko.observableArray([]),
    agentes: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.multaController.multa;
        form.id(data.id);
        form.causa_id(data.causa_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.multaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.multaController;

        Object.keys(self.multa).forEach(function(key,index) {
          if(typeof self.multa[key]() === "string") 
            self.multa[key]("")
          else if (typeof self.multa[key]() === "boolean") 
            self.multa[key](true)
          else if (typeof self.multa[key]() === "number") 
            self.multa[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.multaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.multaController;
     //validar formulario
        if (!model.validateForm('#multaForm')) { 
            return;
        }

        self.multa.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.multaController;
        var data = self.multa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        multaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.multaController;
        var data = self.multa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        multaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.multaController;
        bootbox.confirm({ 
            title: "eliminar multa",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    multaService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.returnGrid();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    cancelar: function () {
        let self = model.multaController;
        self.returnGrid();

        model.clearErrorMessage('#multaForm');
    },

    returnGrid(){
        let self = model.multaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.getAll()
    },

    getAll: function(){
        let self = model.multaController;
        //llamada al servicio
        multaService.getAll()
        .then(r => {
            self.multas(r.data);
        })
        .catch(r => {});
    },

    getCausas: function(){
        let self = model.multaController;
        //llamada al servicio
        causaService.getAll()
        .then(r => {
            self.causas(r.data);
        })
        .catch(r => {});
    },

    getTipoMultas: function(){
        let self = model.multaController;
        //llamada al servicio
        tipoMultaService.getAll()
        .then(r => {
            self.tipos(r.data);
        })
        .catch(r => {});
    },

    getPilotos: function(){
        let self = model.multaController;
        //llamada al servicio
        lineaChoferService.getAll()
        .then(r => {
            self.pilotos(r.data);
        })
        .catch(r => {});
    },

    getAgentes: function(){
        let self = model.multaController;
        //llamada al servicio
        personaService.getAll()
        .then(r => {
            self.agentes([]);

            r.data.forEach(function(item){
                if(item.tipo_persona.nombre.substring(0, 6).toLowerCase() ==='agente'){
                    self.agentes.push(item);
                }
            })
        })
        .catch(r => {});
    },

    causaChange: function(causa){
        let self = model.multaController;
        console.log(causa);
    },

    initialize: function () {
        var self = model.multaController;
        self.getAll();
        self.getCausas();
        self.getTipoMultas();
        self.getPilotos();
        self.getAgentes();
    }
};

this.model.multaController.multa.causa_id.subscribe(function(value) {
    let self = model.multaController;
    self.causas().forEach(function(causa){
        if(causa.id === value){
            self.multa.total_a_pagar(causa.monto.monto);
        }
    });
}, this)

this.model.multaController.multa.linea_chofer_id.subscribe(function(value) {
    let self = model.multaController;
    self.pilotos().forEach(function(piloto){
        if(piloto.id === value){
            self.multa.transporte_id(piloto.linea.transporte_actual.id);
            self.multa.transporte('placa: '+piloto.linea.transporte_actual.placa);
            self.multa.no_linea(piloto.linea.no_linea);
        }
    });
}, this)