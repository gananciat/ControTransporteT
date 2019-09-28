model.pagoMultaController = {

    pagoMulta: {
        id: ko.observable(null),
        fecha_multa: ko.observable(""),
        observacion: ko.observable(""),
        fecha_pago: ko.observable(""),
        total_pagado: ko.observable(null),
        isDescuento: ko.observable(false),
        descuento: ko.observable(0),
        fuera_de_tiempo: ko.observable(false),

        causa_multa: ko.observable(""),
        tipo_multa: ko.observable(""),
        total_multa: ko.observable(""),
        placa_transporte: ko.observable(""),
        no_chasis: ko.observable(""),
        no_motor: ko.observable(""),
        piloto: ko.observable(""),
        dpi_piloto: ko.observable(""),
        linea: ko.observable(""),
        agente: ko.observable(""),
        porcentaje_descuento: ko.observable(""),
        tarjeta_circulacion: ko.observable(""),
        no_inspeccion: ko.observable(""),
        fecha_inspeccion: ko.observable("")
    },

    multas: ko.observableArray([]),
    allArrayMultas: ko.observableArray([]),
    
    estado: ko.observable('Pendientes'),
    pilotos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.pagoMultaController.pagoMulta;
        form.id(data.id);
        form.fecha_pago(data.fecha_pago);
        form.total_pagado(data.total_a_pagar);
        form.total_multa(data.causa.monto.monto);
        form.causa_multa(data.causa.nombre);
        form.piloto(data.linea_chofer.chofer.nombre_uno+' '+data.linea_chofer.chofer.apellido_uno);
        form.dpi_piloto(data.linea_chofer.chofer.cui);
        form.linea(data.linea_chofer.linea.no_linea);
        form.tipo_multa(data.tipo_multa.nombre);
        form.agente(data.agente.nombre_uno+' '+data.agente.apellido_uno);
        form.placa_transporte(data.transporte.placa);
        form.no_chasis(data.transporte.no_chasis);
        form.no_motor(data.transporte.no_motor);
        form.porcentaje_descuento(data.causa.monto.porcentaje_descuento);
        form.tarjeta_circulacion(data.transporte.no_tarjeta);

        if(data.inspeccion_multa !== null){
            form.no_inspeccion(data.inspeccion_multa.inspeccion.numero);
            form.fecha_inspeccion(data.inspeccion_multa.inspeccion.fecha);
        }
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.pagoMultaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.pagoMultaController;

        Object.keys(self.pagoMulta).forEach(function(key,index) {
          if(typeof self.pagoMulta[key]() === "string") 
            self.pagoMulta[key]("")
          else if (typeof self.pagoMulta[key]() === "boolean") 
            self.pagoMulta[key](false)
          else if (typeof self.pagoMulta[key]() === "number") 
            self.pagoMulta[key](null)
        });

        self.pagoMulta.descuento(0);
        self.pagoMulta.total_pagado(0);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.pagoMultaController;
        self.map(data);
        self.multa = data;

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.pagoMultaController;
        
        var fecha_multa = moment(self.multa.fecha_multa);

        var new_date = moment(fecha_multa).add(self.multa.tipo_multa.tiempo_expira, 'd')._d;


        if(moment(self.pagoMulta.fecha_pago()).format('YYYY-MM-DD') > moment(new_date).format('YYYY-MM-DD')){
            self.pagoMulta.fuera_de_tiempo(true);
        }

     //validar formulario
        if (!model.validateForm('#pagoMultaForm')) { 
            return;
        }

        self.update()
    },


     update: function () {
        let self = model.pagoMultaController;
        var data = self.pagoMulta;
        var dataParams = ko.toJS(data);
        dataParams.pagado = true;

        //llamada al servicio
        multaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.pagoMultaController;
        bootbox.confirm({ 
            title: "eliminar pagoMulta",
            message: "¿Esta seguro que quiere anula pagoMulta?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    pagoMultaService.destroy(data)
                    .then(r => {
                        toastr.info("pagoMulta ah sido anulada con éxito",'éxito');
                        self.returnGrid();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    //revertir pago
    revertir: function (data) {
        let self= model.pagoMultaController;
        bootbox.confirm({ 
            title: "revertir pago de multa",
            message: "¿Esta seguro que quiere revertir pago?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    multaService.revertir(data)
                    .then(r => {
                        toastr.info("pago fue revertido con exito",'éxito');
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
        let self = model.pagoMultaController;
        self.returnGrid();

        model.clearErrorMessage('#pagoMultaForm');
    },

    returnGrid(){
        let self = model.pagoMultaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.clearData();
        self.getAll();
        self.estado('Pendientes ');
    },

    getAll: function(){
        let self = model.pagoMultaController;
        //llamada al servicio
        multaService.getAll()
        .then(r => {
            self.allArrayMultas(r.data);
            r.data = r.data.filter(x=>!x.pagado && x.deleted_at === null);
            self.multas(r.data);
        })
        .catch(r => {});
    },

    getPilotos: function(){
        let self = model.pagoMultaController;
        //llamada al servicio
        personaService.getAll()
        .then(r => {
            self.pilotos([]);

            r.data.forEach(function(item){
                if(item.tipo_persona.nombre.substring(0, 6).toLowerCase() ==='piloto'){
                    self.pilotos.push(item);
                }
            })
        })
        .catch(r => {});
    },

    //setear monto de contrato
    setMonto: function(){
        let self = model.pagoMultaController;
        var porc = self.multa.causa.monto.porcentaje_descuento;
        var multa_p = self.multa.total_a_pagar;
        var descuento = multa_p * (porc/100);
        var multa_descuento = multa_p - descuento;

        if(self.pagoMulta.isDescuento()){
          self.pagoMulta.total_pagado(multa_descuento);
          self.pagoMulta.descuento(descuento)  
          }else{
            self.pagoMulta.total_pagado(multa_p);
            self.pagoMulta.descuento(0);
          }
        
    },

    //show files
    showMultas: function(pagado){
        let self = model.pagoMultaController;
        !pagado ? self.estado('Pendientes') : self.estado('Pagadas');
        var multas = self.allArrayMultas();
        multas = multas.filter(x=>x.pagado === pagado && x.deleted_at === null);
        self.multas(multas);
    },

    initialize: function () {
        var self = model.pagoMultaController;
        self.getAll();
        self.getPilotos();
    }
};