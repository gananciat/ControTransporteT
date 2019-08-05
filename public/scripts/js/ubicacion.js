model.ubicacionController = {

    ubicacion: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    ubicacions: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.ubicacionController.ubicacion;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.ubicacionController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.ubicacionController;

        Object.keys(self.ubicacion).forEach(function(key,index) {
          if(typeof self.ubicacion[key]() === "string") 
            self.ubicacion[key]("")
          else if (typeof self.ubicacion[key]() === "boolean") 
            self.ubicacion[key](true)
          else if (typeof self.ubicacion[key]() === "number") 
            self.ubicacion[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.ubicacionController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.ubicacionController;
     //validar formulario
        if (!model.validateForm('#ubicacionForm')) { 
            return;
        }

        self.ubicacion.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.ubicacionController;
        var data = self.ubicacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        ubicacionService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.ubicacionController;
        var data = self.ubicacion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        ubicacionService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.ubicacionController;
        bootbox.confirm({ 
            title: "eliminar ubicacion",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    ubicacionService.destroy(data)
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
        let self = model.ubicacionController;
        self.returnGrid();

        model.clearErrorMessage('#ubicacionForm');
    },

    returnGrid(){
        let self = model.ubicacionController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.ubicacionController;

        //llamada al servicio
        ubicacionService.getAll()
        .then(r => {
            self.ubicacions(r.data);
        })
        .catch(r => {});
    }
};