model.tipoPersonaController = {

    tipo_persona: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    tipo_personas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoPersonaController.tipo_persona;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoPersonaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.tipoPersonaController;

        Object.keys(self.tipo_persona).forEach(function(key,index) {
          if(typeof self.tipo_persona[key]() === "string") 
            self.tipo_persona[key]("")
          else if (typeof self.tipo_persona[key]() === "boolean") 
            self.tipo_persona[key](true)
          else if (typeof self.tipo_persona[key]() === "number") 
            self.tipo_persona[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoPersonaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.tipoPersonaController;
     //validar formulario
        if (!model.validateForm('#tipoForm')) { 
            return;
        }

        self.tipo_persona.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.tipoPersonaController;
        var data = self.tipo_persona;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoPersonaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.tipoPersonaController;
        var data = self.tipo_persona;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoPersonaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.tipoPersonaController;
        bootbox.confirm({ 
            title: "eliminar tipo persona",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoPersonaService.destroy(data)
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
        let self = model.tipoPersonaController;
        self.returnGrid();

        model.clearErrorMessage('#tipoForm');
    },

    returnGrid(){
        let self = model.tipoPersonaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.tipoPersonaController;

        //llamada al servicio
        tipoPersonaService.getAll()
        .then(r => {
            self.tipo_personas(r.data);
        })
        .catch(r => {});
    }
};