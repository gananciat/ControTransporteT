model.transporteController = {

    transporte: {
        id: ko.observable(null),
        linea_id: ko.observable(null),
        placa: ko.observable(""),
        modelo: ko.observable(""),
        marca_transporte_id: ko.observable(null),
        no_tarjeta: ko.observable(""),
        no_seguro: ko.observable(""),
        linea_transporte: ko.observable(""),
        no_motor: ko.observable(""),
        no_chasis: ko.observable(""),
        color: ko.observable(""),
    },

    transportes: ko.observableArray([]),
    marcas: ko.observableArray([]),
    lineas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    linea_anterior_id: ko.observable(null),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var self = model.transporteController;
        var form = self.transporte;
        console.log(data)
        form.id(data.id);
        form.linea_id(data.linea_id);
        form.placa(data.placa);
        form.modelo(data.modelo);
        form.marca_transporte_id(data.marca_transporte_id);
        form.no_tarjeta(data.no_tarjeta);
        form.no_seguro(data.no_seguro);
        form.linea_transporte(data.linea_transporte);
        form.no_motor(data.no_motor);
        form.no_chasis(data.no_chasis);
        form.color(data.color);
        self.linea_anterior_id(data.linea_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.transporteController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.transporteController;

        Object.keys(self.transporte).forEach(function(key,index) {
          if(typeof self.transporte[key]() === "string") 
            self.transporte[key]("")
          else if (typeof self.transporte[key]() === "boolean") 
            self.transporte[key](true)
          else if (typeof self.transporte[key]() === "number") 
            self.transporte[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.transporteController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.transporteController;
     //validar formulario
        if (!model.validateForm('#transporteForm')) { 
            return;
        }

        self.transporte.id() === null ? self.beforeCreate() : self.beforeUpdate()
    },

    beforeCreate: function(){
        let self = model.transporteController;
        var existe = self.validateIfExists(self.transporte.linea_id());
        
        if(existe !== undefined){
            bootbox.confirm({ 
                title: "cambiar transporte",
                message: "¿Linea ya tiene transporte asignado, desea reemplazarlo?",
                callback: function(result){ 
                    if (result) {
                        self.create()
                    }
                }
            })
        }else{
            self.create()
        }
    },

    beforeUpdate: function(){
        let self = model.transporteController;
    
        if(self.transporte.linea_id() !== self.linea_anterior_id()){
            var existe = self.validateIfExists(self.transporte.linea_id());
            var message = existe === undefined ? "Usted esta actualizando, transporte placas"
                                                +self.transporte.placa()+ " a otra linea ¿esta seguro de realizar el cambio de transporte?" : "transporte placas"
                                                +self.transporte.placa()+ " ya está asignado a otra linea, ¿esta seguro de realizar el cambio de transporte?" 
            bootbox.confirm({ 
                title: "cambiar transporte",
                message: message,
                callback: function(result){ 
                    if (result) {
                        self.update()
                    }
                }
            })
        }else{
            self.update()
        }
    },

    validateIfExists: function(linea_id){
        let self = model.transporteController;
        var tipo = self.transportes().find(x => x.linea_id === linea_id && x.actual === 1);
        return tipo;
    },

    create: function () {
        let self = model.transporteController;
        var data = self.transporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        transporteService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.transporteController;
        var data = self.transporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        transporteService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.transporteController;
        bootbox.confirm({ 
            title: "eliminar transporte",
            message: "¿Esta seguro que quiere eliminar " + data.placa + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    transporteService.destroy(data)
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
        let self = model.transporteController;
        self.returnGrid();

        model.clearErrorMessage('#transporteForm');
    },

    returnGrid(){
        let self = model.transporteController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.getAll()
    },

    getLineas: function(){
        let self = model.transporteController;
        //llamada al servicio
        lineaService.getAll()
        .then(r => {
            self.lineas(r.data);
        })
        .catch(r => {});
    },

    getMarcas: function () {
        var self = model.transporteController;

        //llamada al servicio
        marcaTransporteService.getAll()
        .then(r => {
            self.marcas(r.data);
        })
        .catch(r => {});
    },

    getAll: function(){
        var self = model.transporteController;

        //llamada al servicio
        transporteService.getAll()
        .then(r => {
            self.transportes(r.data);
        })
        .catch(r => {});
    },

    initialize: function () {
        var self = model.transporteController;
        self.getAll();
        self.getLineas();
        self.getMarcas();
    }
};