model.tipoUsuarioController = {

    tipo_usuario: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    tipo_usuarios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoUsuarioController.tipo_usuario;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoUsuarioController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.tipoUsuarioController;

        Object.keys(self.tipo_usuario).forEach(function(key,index) {
          if(typeof self.tipo_usuario[key]() === "string") 
            self.tipo_usuario[key]("")
          else if (typeof self.tipo_usuario[key]() === "boolean") 
            self.tipo_usuario[key](true)
          else if (typeof self.tipo_usuario[key]() === "number") 
            self.tipo_usuario[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoUsuarioController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.tipoUsuarioController;
     //validar formulario
        if (!model.validateForm('#tipoForm')) { 
            return;
        }

        self.tipo_usuario.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.tipoUsuarioController;
        var data = self.tipo_usuario;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoUsuarioService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.tipoUsuarioController;
        var data = self.tipo_usuario;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoUsuarioService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.tipoUsuarioController;
        bootbox.confirm({ 
            title: "eliminar tipo persona",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoUsuarioService.destroy(data)
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
        let self = model.tipoUsuarioController;
        self.returnGrid();

        model.clearErrorMessage('#tipoForm');
    },

    returnGrid(){
        let self = model.tipoUsuarioController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.tipoUsuarioController;

        //llamada al servicio
        tipoUsuarioService.getAll()
        .then(r => {
            self.tipo_usuarios(r.data);
        })
        .catch(r => {});
    }
};