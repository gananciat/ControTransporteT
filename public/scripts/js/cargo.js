model.cargoController = {

    cargo: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    cargos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cargoController.cargo;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cargoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.cargoController;

        Object.keys(self.cargo).forEach(function(key,index) {
          if(typeof self.cargo[key]() === "string") 
            self.cargo[key]("")
          else if (typeof self.cargo[key]() === "boolean") 
            self.cargo[key](true)
          else if (typeof self.cargo[key]() === "number") 
            self.cargo[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.cargoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.cargoController;
     //validar formulario
        if (!model.validateForm('#cargoForm')) { 
            return;
        }

        self.cargo.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.cargoController;
        var data = self.cargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cargoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.cargoController;
        var data = self.cargo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cargoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.cargoController;
        bootbox.confirm({ 
            title: "eliminar cargo",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cargoService.destroy(data)
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
        let self = model.cargoController;
        self.returnGrid();

        model.clearErrorMessage('#cargoForm');
    },

    returnGrid(){
        let self = model.cargoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.cargoController;

        //llamada al servicio
        cargoService.getAll()
        .then(r => {
            self.cargos(r.data);
        })
        .catch(r => {});
    }
};