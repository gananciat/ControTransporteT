model.causaController = {

    causa: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        monto_multa_id: ko.observable(null)
    },

    causas: ko.observableArray([]),
    montos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.causaController.causa;
        form.id(data.id);
        form.nombre(data.nombre);
        form.monto_multa_id(data.monto_multa_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.causaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.causaController;

        Object.keys(self.causa).forEach(function(key,index) {
          if(typeof self.causa[key]() === "string") 
            self.causa[key]("")
          else if (typeof self.causa[key]() === "boolean") 
            self.causa[key](true)
          else if (typeof self.causa[key]() === "number") 
            self.causa[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.causaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.causaController;
     //validar formulario
        if (!model.validateForm('#causaForm')) { 
            return;
        }

        self.causa.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.causaController;
        var data = self.causa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        causaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.causaController;
        var data = self.causa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        causaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.causaController;
        bootbox.confirm({ 
            title: "eliminar causa",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    causaService.destroy(data)
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
        let self = model.causaController;
        self.returnGrid();

        model.clearErrorMessage('#causaForm');
    },

    returnGrid(){
        let self = model.causaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getMontos: function(){
        let self = model.causaController;
        //llamada al servicio
        montoMultaService.getAll()
        .then(r => {
            self.montos(r.data);
        })
        .catch(r => {});

    },

    initialize: function () {
        var self = model.causaController;

        //llamada al servicio
        causaService.getAll()
        .then(r => {
            self.causas(r.data);
        })
        .catch(r => {});

        self.getMontos();
    }
};