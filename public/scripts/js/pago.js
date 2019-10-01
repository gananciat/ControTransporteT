model.pagoController = {

    pago: {
        id: ko.observable(null),
        propietario_linea_id: ko.observable(null),
        concepto_pago_anio_id: ko.observable(null),
        total: ko.observable(null),
        propietario: ko.observable(''),
        concepto: ko.observableArray([]),
        linea_id:ko.observable(2)
    },

    propietario_id: ko.observable(null),
    pagos: ko.observableArray([]),
    propietarios: ko.observableArray([]),
    anios: ko.observableArray([]),
    lineas: ko.observableArray([]),
    concepto_pagos: ko.observableArray([]),
    propietarioPagos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    flag: ko.observable(true),


    //mapear funcion para editar
    map: function (data) {
        var form = model.pagoController.pago;
        form.propietario(data.nombre_uno+' '+data.apellido_uno);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.pagoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.pagoController;
        Object.keys(self.pago).forEach(function(key,index) {
          if(typeof self.pago[key]() === "string") 
            self.pago[key]("")
          else if (typeof self.pago[key]() === "boolean") 
            self.pago[key](true)
          else if (typeof self.pago[key]() === "number") 
            self.pago[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.pagoController;
        self.propietario_id(data.id);
        self.map(data);
        self.getLineas(data.id);
        //self.map(data);

        self.getPagos(data.id);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.pagoController;
        console.log(self.pago)
     //validar formulario
        if (!model.validateForm('#pagoForm')) { 
            return;
        }

        self.pago.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.pagoController;
        var data = self.pago;
        var dataParams = ko.toJS(data);

        var exists = self.pagos().filter(x=>x.propietario_linea_id === dataParams.propietario_linea_id
         && x.concepto_pago_anio_id === dataParams.concepto_pago_anio_id && !x.anulado);

        if(exists.length > 0){
            toastr.error('concepto de pago ya fue realizado para año seleccionado','error');
            return
        }

        //llamada al servicio
        pagoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.getAll();  
            self.getPagos(self.propietario_id());
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.pagoController;
        var data = self.pago;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        pagoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.pagoController;
        bootbox.confirm({ 
            title: "eliminar pago",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    pagoService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.getAll();  
                        self.getPagos(self.propietario_id());

                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    anular: function (data) {
        let self= model.pagoController;
        bootbox.confirm({ 
            title: "anular pago",
            message: "¿Esta seguro que quiere anular pago?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    pagoService.anular(data)
                    .then(r => {
                        toastr.info("registro anulado con éxito",'éxito');
                        self.getAll();  
                        self.getPagos(self.propietario_id());
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    cancelar: function () {
        let self = model.pagoController;
        self.returnGrid();

        model.clearErrorMessage('#pagoForm');
    },

    returnGrid: function(){
        let self = model.pagoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    volver: function(){
        let self = model.pagoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
    },

    getPropietarios: function(){
        let self = model.pagoController;
         //llamada al servicio
        personaService.getAll()
        .then(r => {
            self.propietarios([]);
            r.data.forEach(function(item){
                if(item.tipo_persona.nombre.substring(0,11).toLowerCase() == 'propietario'){
                    self.propietarios.push(item);
                }
            })
        })
        .catch(r => {});
    },

    getAnios: function(anio){
        let self = model.pagoController;
        anioService.getAll()
        .then(r => {
            self.anios(r.data);
        })
        .catch(r => {});
    },

    getLineas: function(id){
        let self = model.pagoController;
        personaService.getLineas(id)
        .then(r => {
            self.lineas(r.data);
        })
        .catch(r => {});
    },

    getPagos: function(id){
        let self = model.pagoController;
        personaService.getPagos(id)
        .then(r => {
            self.propietarioPagos(r.data);
        })
        .catch(r => {});
    },

    setTotal: function(){
        let self = model.pagoController;
        self.concepto_pagos().forEach(function(c){
            if(c.id === self.pago.concepto_pago_anio_id()){
                self.pago.total(c.cuota);
            }
        })
    },

    getConceptos: function(){
        let self = model.pagoController;
        self.concepto_pagos(self.pago.concepto());
        self.pago.total(null);
    },


    showTable: function(flag){
        let self = model.pagoController;
        self.flag(flag);
    },

    getAll: function(){
        //llamada al servicio
        let self = model.pagoController;
        pagoService.getAll()
        .then(r => {
            self.pagos(r.data);
        })
        .catch(r => {});
    },

    initialize: function () {
        var self = model.pagoController;

        //llamada al servicio
        self.getAll();

        self.getPropietarios();
        self.getAnios();
    }
};