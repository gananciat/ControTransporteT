model.lineaController = {
    linea: {
        id: ko.observable(null),
        no_linea: ko.observable(""),
        tipo_transporte_id: ko.observable(null),
        ruta_id: ko.observable(null),
        propietario_id: ko.observable(null),
        placa: ko.observable(""),
        modelo: ko.observable(""),
        marca_transporte_id: ko.observable(null),
        no_tarjeta: ko.observable(""),
        no_seguro: ko.observable(""),
        linea_transporte: ko.observable(""),
        no_motor: ko.observable(""),
        no_chasis: ko.observable(""),
        color: ko.observable(""),
        chofer_titular: ko.observable(""),
        chofer_suplente: ko.observable(""),
        tipo_chofer: ko.observable("")
    },

    flags: {
        showLinea: ko.observable(false),
        showTransporte: ko.observable(false),
        showPiloto: ko.observable(false)
    },

    lineas: ko.observableArray([]),
    rutas: ko.observableArray([]),
    pilotos: ko.observableArray([]),
    propietarios: ko.observableArray([]),
    tipoTransportes: ko.observableArray([]),
    marcas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    tipoChofer: [{ nombre: 'Titular', valor: 'T' }, { nombre: 'Suplente', valor: 'S' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.lineaController.linea;
        form.id(data.id);
        form.no_linea(data.no_linea);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.lineaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);

       self.flags.showLinea(true);
       self.flags.showTransporte(false);
       self.flags.showPiloto(false);
    },

    clearData: function(){
       let self = model.lineaController;

        Object.keys(self.linea).forEach(function(key,index) {
          if(typeof self.linea[key]() === "string") 
            self.linea[key]("")
          else if (typeof self.linea[key]() === "boolean") 
            self.linea[key](true)
          else if (typeof self.linea[key]() === "number") 
            self.linea[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.lineaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.lineaController;
     //validar formulario
        if (!model.validateForm('#lineaForm')) { 
            return;
        }

        self.linea.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.lineaController;
        var data = self.linea;
        var dataParams = ko.toJS(data);

        if(self.validateNoLinea(dataParams.no_linea,dataParams.tipo_transporte_id)){
            toastr.error("no de linea para tipo de transporte ya existe","error");
            return
        }

        if(dataParams.chofer_titular === dataParams.chofer_suplente){
            toastr.error("piloto titular no puede se el mismo que el piloto suplente","error");
            return
        }

        //llamada al servicio
        lineaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    validateNoLinea(linea,tipo_transporte){
        let self = model.lineaController;
        var existe = false;
        self.lineas().forEach(function(item){
            if(item.no_linea === parseInt(linea) && item.tipo_transporte_id === tipo_transporte){
                existe = true;
            }
        })
        return existe;
    },

     update: function () {
        let self = model.lineaController;
        var data = self.linea;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        lineaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.lineaController;
        bootbox.confirm({ 
            title: "eliminar linea",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    lineaService.destroy(data)
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
        let self = model.lineaController;
        self.returnGrid();

        model.clearErrorMessage('#lineaForm');
    },

    returnGrid(){
        let self = model.lineaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    showFormulario: function(flag){
        let self = model.lineaController;

        if (!model.validateForm('#lineaForm')) { 
            toastr.error("por favor complete los campos obligatorios","error");
            return;
        }

        Object.keys(self.flags).forEach(function(key,index) {
            self.flags[key](false)
            if(key === flag){
                self.flags[key](true)
            }
        })
    },

    getAll: function(){
        let self = model.lineaController;
         //llamada al servicio
        lineaService.getAll()
        .then(r => {
            self.lineas(r.data);
        })
        .catch(r => {});

    },

    getTipoTransportes: function(){
        let self = model.lineaController;
         //llamada al servicio
        tipoTransporteService.getAll()
        .then(r => {
            self.tipoTransportes(r.data);
        })
        .catch(r => {});
    },

    getPersonas: function(){
        let self = model.lineaController;
         //llamada al servicio
        personaService.getAll()
        .then(r => {
            self.propietarios([]);
            self.pilotos([]);
            r.data.forEach(function(item){
                if(item.tipo_persona.nombre.substring(0,11).toLowerCase() == 'propietario'){
                    self.propietarios.push(item);
                }else if(item.tipo_persona.nombre.substring(0,6).toLowerCase() == 'piloto'){
                    self.pilotos.push(item);
                }
            })
        })
        .catch(r => {});
    },

    getRutas: function(){
        let self = model.lineaController;
         //llamada al servicio
        rutaService.getAll()
        .then(r => {
            self.rutas(r.data);
        })
        .catch(r => {});
    },

    getMarcas: function(){
        let self = model.lineaController;
         //llamada al servicio
        marcaTransporteService.getAll()
        .then(r => {
            self.marcas(r.data);
        })
        .catch(r => {});
    },

    initializePropietario: function(linea){
        let self = model.lineaController;
        model.propietarioLineaController.initialize(linea.id);
        self.map(linea);
    },

    initializeChofer: function(linea){
        let self = model.lineaController;
        model.lineaChoferController.initialize(linea.id);
        self.map(linea);
    },

    initialize: function () {
        var self = model.lineaController;
        self.getAll();
        self.getPersonas();
        self.getRutas();
        self.getTipoTransportes();
        self.getMarcas();
    }
};