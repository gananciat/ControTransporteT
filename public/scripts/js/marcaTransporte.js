model.marcaTransporteController = {

    marcaTransporte: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    marcaTransportes: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.marcaTransporteController.marcaTransporte;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.marcaTransporteController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.marcaTransporteController;

        Object.keys(self.marcaTransporte).forEach(function(key,index) {
          if(typeof self.marcaTransporte[key]() === "string") 
            self.marcaTransporte[key]("")
          else if (typeof self.marcaTransporte[key]() === "boolean") 
            self.marcaTransporte[key](true)
          else if (typeof self.marcaTransporte[key]() === "number") 
            self.marcaTransporte[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.marcaTransporteController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.marcaTransporteController;
     //validar formulario
        if (!model.validateForm('#marcaTransporteForm')) { 
            return;
        }

        self.marcaTransporte.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.marcaTransporteController;
        var data = self.marcaTransporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        marcaTransporteService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.marcaTransporteController;
        var data = self.marcaTransporte;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        marcaTransporteService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.marcaTransporteController;
        bootbox.confirm({ 
            title: "eliminar marcaTransporte",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    marcaTransporteService.destroy(data)
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
        let self = model.marcaTransporteController;
        self.returnGrid();

        model.clearErrorMessage('#marcaTransporteForm');
    },

    returnGrid(){
        let self = model.marcaTransporteController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.marcaTransporteController;

        //llamada al servicio
        marcaTransporteService.getAll()
        .then(r => {
            self.marcaTransportes(r.data);
        })
        .catch(r => {});
    }
};