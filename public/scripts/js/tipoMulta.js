model.tipoMultaController = {

    tipoMulta: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        tiempo_expira: ko.observable(null)
    },

    tipoMultas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoMultaController.tipoMulta;
        form.id(data.id);
        form.nombre(data.nombre);
        form.tiempo_expira(data.tiempo_expira);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoMultaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.tipoMultaController;

        Object.keys(self.tipoMulta).forEach(function(key,index) {
          if(typeof self.tipoMulta[key]() === "string") 
            self.tipoMulta[key]("")
          else if (typeof self.tipoMulta[key]() === "boolean") 
            self.tipoMulta[key](true)
          else if (typeof self.tipoMulta[key]() === "number") 
            self.tipoMulta[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoMultaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.tipoMultaController;
     //validar formulario
        if (!model.validateForm('#tipoMultaForm')) { 
            return;
        }

        self.tipoMulta.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.tipoMultaController;
        var data = self.tipoMulta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoMultaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.tipoMultaController;
        var data = self.tipoMulta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoMultaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.tipoMultaController;
        bootbox.confirm({ 
            title: "eliminar tipoMulta",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoMultaService.destroy(data)
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
        let self = model.tipoMultaController;
        self.returnGrid();

        model.clearErrorMessage('#tipoMultaForm');
    },

    returnGrid(){
        let self = model.tipoMultaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.tipoMultaController;

        //llamada al servicio
        tipoMultaService.getAll()
        .then(r => {
            self.tipoMultas(r.data);
        })
        .catch(r => {});
    }
};