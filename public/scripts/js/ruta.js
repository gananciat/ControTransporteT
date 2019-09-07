model.rutaController = {

    ruta: {
        id: ko.observable(null),
        ubicacion_id: ko.observable(null),
        destino_id: ko.observable(null)
    },

    rutas: ko.observableArray([]),
    ubicaciones: ko.observableArray([]),
    destinos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),


    //mapear funcion para editar
    map: function (data) {
        var form = model.rutaController.ruta;
        form.id(data.id);
        form.ubicacion_id(data.ubicacion_id);
        form.destino_id(data.destino_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.rutaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.rutaController;

        Object.keys(self.ruta).forEach(function(key,index) {
          if(typeof self.ruta[key]() === "string") 
            self.ruta[key]("")
          else if (typeof self.ruta[key]() === "boolean") 
            self.ruta[key](true)
          else if (typeof self.ruta[key]() === "number") 
            self.ruta[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.rutaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.rutaController;
     //validar formulario
        if (!model.validateForm('#rutaForm')) { 
            return;
        }

        self.ruta.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.rutaController;
        var data = self.ruta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        rutaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.rutaController;
        var data = self.ruta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        rutaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.rutaController;
        bootbox.confirm({ 
            title: "eliminar ruta",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    rutaService.destroy(data)
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
        let self = model.rutaController;
        self.returnGrid();

        model.clearErrorMessage('#rutaForm');
    },

    returnGrid: function(){
        let self = model.rutaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getDestinos: function(){
        let self = model.rutaController;
        destinoService.getAll()
        .then(r => {
            self.destinos(r.data);
        })
        .catch(r => {});
    },

    getUbicaciones: function(){
        let self = model.rutaController;
        ubicacionService.getAll()
        .then(r => {
            self.ubicaciones(r.data);
        })
        .catch(r => {});
    },

    initialize: function () {
        var self = model.rutaController;

        //llamada al servicio
        rutaService.getAll()
        .then(r => {
            self.rutas(r.data);
        })
        .catch(r => {});

        self.getDestinos();
        self.getUbicaciones();
    }
};