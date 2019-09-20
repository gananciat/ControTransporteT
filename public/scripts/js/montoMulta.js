model.montoMultaController = {

    montoMulta: {
        id: ko.observable(null),
        monto: ko.observable(null),
        porcentaje_descuento: ko.observable(null)
    },

    montoMultas: ko.observableArray([]),
    causas:ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    infoMode: ko.observable(false),
    //tipoOpcion: [{ monto: 'Producto', valor: 'P' }, { monto: 'Materia Prima', valor: 'M' }, { monto: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.montoMultaController.montoMulta;
        form.id(data.id);
        form.monto(data.monto);
        form.porcentaje_descuento(data.porcentaje_descuento);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.montoMultaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.montoMultaController;

        Object.keys(self.montoMulta).forEach(function(key,index) {
          if(typeof self.montoMulta[key]() === "string") 
            self.montoMulta[key]("")
          else if (typeof self.montoMulta[key]() === "boolean") 
            self.montoMulta[key](true)
          else if (typeof self.montoMulta[key]() === "number") 
            self.montoMulta[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.montoMultaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.montoMultaController;
     //validar formulario
        if (!model.validateForm('#montoMultaForm')) { 
            return;
        }

        self.montoMulta.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.montoMultaController;
        var data = self.montoMulta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        montoMultaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.montoMultaController;
        var data = self.montoMulta;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        montoMultaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.montoMultaController;
        bootbox.confirm({ 
            title: "eliminar montoMulta",
            message: "¿Esta seguro que quiere eliminar " + data.monto + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    montoMultaService.destroy(data)
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
        let self = model.montoMultaController;
        self.returnGrid();

        model.clearErrorMessage('#montoMultaForm');
    },

    returnGrid(){
        let self = model.montoMultaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.infoMode(false);
        self.clearData();
        self.initialize();
    },

    volver: function(){
        let self = model.montoMultaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.infoMode(false);
    },

    setCausas: function(data){
        let self = model.montoMultaController;
        self.map(data);
        self.causas(data.causas);
        self.editMode(false);
        self.insertMode(false);
        self.infoMode(true);
        self.gridMode(false);
    },

    initialize: function () {
        var self = model.montoMultaController;

        //llamada al servicio
        montoMultaService.getAll()
        .then(r => {
            self.montoMultas(r.data);
            console.log(self.montoMultas());
        })
        .catch(r => {});
    }
};