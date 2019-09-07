model.tipoTransporteController = {

    tipoTransporte: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    tipoTransportes: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.tipoTransporteController.tipoTransporte;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.tipoTransporteController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.tipoTransporteController;

        Object.keys(self.tipoTransporte).forEach(function(key,index) {
          if(typeof self.tipoTransporte[key]() === "string") 
            self.tipoTransporte[key]("")
          else if (typeof self.tipoTransporte[key]() === "boolean") 
            self.tipoTransporte[key](true)
          else if (typeof self.tipoTransporte[key]() === "number") 
            self.tipoTransporte[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.tipoTransporteController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.tipoTransporteController;
     //validar formulario
        if (!model.validateForm('#tipoTransporteForm')) { 
            return;
        }

        self.tipoTransporte.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.tipoTransporteController;
        var data = self.tipoTransporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoTransporteService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.tipoTransporteController;
        var data = self.tipoTransporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        tipoTransporteService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.tipoTransporteController;
        bootbox.confirm({ 
            title: "eliminar tipoTransporte",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    tipoTransporteService.destroy(data)
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
        let self = model.tipoTransporteController;
        self.returnGrid();

        model.clearErrorMessage('#tipoTransporteForm');
    },

    returnGrid(){
        let self = model.tipoTransporteController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.tipoTransporteController;

        //llamada al servicio
        tipoTransporteService.getAll()
        .then(r => {
            self.tipoTransportes(r.data);
        })
        .catch(r => {});
    }
};