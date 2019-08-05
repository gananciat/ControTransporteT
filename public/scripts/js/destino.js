model.destinoController = {

    destino: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    destinos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.destinoController.destino;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.destinoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.destinoController;

        Object.keys(self.destino).forEach(function(key,index) {
          if(typeof self.destino[key]() === "string") 
            self.destino[key]("")
          else if (typeof self.destino[key]() === "boolean") 
            self.destino[key](true)
          else if (typeof self.destino[key]() === "number") 
            self.destino[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.destinoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.destinoController;
     //validar formulario
        if (!model.validateForm('#destinoForm')) { 
            return;
        }

        self.destino.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.destinoController;
        var data = self.destino;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        destinoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.destinoController;
        var data = self.destino;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        destinoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.destinoController;
        bootbox.confirm({ 
            title: "eliminar destino",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    destinoService.destroy(data)
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
        let self = model.destinoController;
        self.returnGrid();

        model.clearErrorMessage('#destinoForm');
    },

    returnGrid(){
        let self = model.destinoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.destinoController;

        //llamada al servicio
        destinoService.getAll()
        .then(r => {
            self.destinos(r.data);
        })
        .catch(r => {});
    }
};