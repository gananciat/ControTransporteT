model.anioController = {

    anio: {
        id: ko.observable(null),
        anio: ko.observable(""),
        cuotas: ko.observableArray([])
    },

    conceptoPagos: ko.observableArray([]),
    anios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    viewMode: ko.observable(false),
    anioConceptos:ko.observableArray([]),
    cuotas: ko.observableArray([]),
    cuotasAnios: ko.observableArray([]),
    //tipoOpcion: [{ anio: 'Producto', valor: 'P' }, { anio: 'Materia Prima', valor: 'M' }, { anio: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.anioController;
        var form = model.anioController.anio;
        form.id(data.id);
        form.anio(data.anio);
        self.cuotasAnios(data.concepto_pago_anios);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.anioController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);

       self.getConceptoPagos();
    },

    clearData: function(){
       let self = model.anioController;

        Object.keys(self.anio).forEach(function(key,index) {
          if(typeof self.anio[key]() === "string") 
            self.anio[key]("")
          else if (typeof self.anio[key]() === "boolean") 
            self.anio[key](true)
          else if (typeof self.anio[key]() === "number") 
            self.anio[key](null)
        });

        self.cuotas([]);
        self.anio.cuotas([]);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.anioController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.anioController;
     //validar formulario
        if (!model.validateForm('#anioForm')) { 
            return;
        }

        self.anio.id() === null ? self.beforeCreate() : self.update()
    },

    beforeCreate(){
        let self = model.anioController;
        self.anio.cuotas = self.cuotas;
        if(!self.validateCuotas()){
            toastr.error('debe ingresar pago de todos los conceptos de pago','error')
            return
        }
        $('#preview').modal('show');
    },

    create: function () {
        let self = model.anioController;
        var data = self.anio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        anioService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    validateCuotas: function(){
        let self = model.anioController;
        var rpta = true
        self.anio.cuotas().forEach(function(item){
            if(item.cuota() === null || item.cuota() === ""){
                rpta = false
            }
        })
        return rpta
    },

     update: function () {
        let self = model.anioController;
        var data = self.anio;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        anioService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.anioController;
        bootbox.confirm({ 
            title: "eliminar anio",
            message: "¿Esta seguro que quiere eliminar " + data.anio + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    anioService.destroy(data)
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
        let self = model.anioController;
        self.returnGrid();

        model.clearErrorMessage('#anioForm');
    },

    returnGrid(){
        let self = model.anioController;
        self.insertMode(false);
        self.editMode(false);
        self.viewMode(false);
        self.gridMode(true);
        self.clearData();
        self.initialize();
    },

    //get concepto pagos
    getConceptoPagos: function (){
        let self= model.anioController;
        //llamada al servicio
        conceptoPagoService.getAll()
        .then(r => {
           self.cuotas([])
           self.conceptoPagos(r.data)
            r.data.forEach(function(item){
                self.cuotas.push({                    
                    id: item.id,
                    nombre: item.nombre,
                    forma_pago: item.forma_pago,
                    cuota: ko.observable(null)  
                })
            })
            
            console.log(self.cuotas)
        })
        .catch(r => {})
    },

    viewInfo: function(data){
        let self = model.anioController;
        self.viewMode(true);
        self.gridMode(false);
        self.insertMode(false);
        self.map(data);
    },

    initialize: function () {
        var self = model.anioController;

        //llamada al servicio
        anioService.getAll()
        .then(r => {
            self.anios(r.data);
        })
        .catch(r => {});
    }
};