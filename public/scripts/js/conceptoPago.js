model.conceptoPagoController = {

    concepto_pago: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        forma_pago: ko.observable("")
    },

    conceptoPagos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    options: [{ nombre: 'Anual', valor: 'A' }, { nombre: 'Mensual', valor: 'M' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.conceptoPagoController.concepto_pago;
        form.id(data.id);
        form.nombre(data.nombre);
        form.forma_pago(data.forma_pago);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.conceptoPagoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.conceptoPagoController;

        Object.keys(self.concepto_pago).forEach(function(key,index) {
          if(typeof self.concepto_pago[key]() === "string") 
            self.concepto_pago[key]("")
          else if (typeof self.concepto_pago[key]() === "boolean") 
            self.concepto_pago[key](true)
          else if (typeof self.concepto_pago[key]() === "number") 
            self.concepto_pago[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.conceptoPagoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.conceptoPagoController;
     //validar formulario
        if (!model.validateForm('#conceptoPagoForm')) { 
            return;
        }

        self.concepto_pago.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.conceptoPagoController;
        var data = self.concepto_pago;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        conceptoPagoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.conceptoPagoController;
        var data = self.concepto_pago;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        conceptoPagoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.conceptoPagoController;
        bootbox.confirm({ 
            title: "eliminar conceptoPago",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    conceptoPagoService.destroy(data)
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
        let self = model.conceptoPagoController;
        self.returnGrid();

        model.clearErrorMessage('#conceptoPagoForm');
    },

    returnGrid(){
        let self = model.conceptoPagoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.conceptoPagoController;

        //llamada al servicio
        conceptoPagoService.getAll()
        .then(r => {
            self.conceptoPagos(r.data);
        })
        .catch(r => {});
    }
};