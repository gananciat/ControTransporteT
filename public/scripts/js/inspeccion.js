model.inspeccionController = {
    inspeccion: {
        id: ko.observable(null),
        numero: ko.observable(null),
        transporte_id: ko.observable(),
        agente_id: ko.observable(null),
        fecha: ko.observable(""),
        total_llantas: ko.observable(false),
        platos: ko.observable(false),
        retrovisores: ko.observable(false),
        antena: ko.observable(false),
        silvines: ko.observable(false),
        stops: ko.observable(false),
        tricket: ko.observable(false),
        herramienta: ko.observable(false),
        placas: ko.observable(false),
        radio: ko.observable(false),
        bocinas_radio: ko.observable(false),
        vidrios: ko.observable(false),
        tapon_conbustible: ko.observable(false),
        tapon_radiadior: ko.observable(false),
        plumillas: ko.observable(false),
        alfombras: ko.observable(false),
        pidevias: ko.observable(false),
        reproductor: ko.observable(false),
        otros_accesorios: ko.observable(""),
        daños: ko.observable(""),
        observacion: ko.observable(""),
        multas: ko.observableArray([]),
        causa_id:ko.observable(null),
        observacion_multa: ko.observable(''),
        total_a_pagar: ko.observable(null),
        causa: ko.observable(''),
        agente: ko.observable(''),
        multasInfo: ko.observableArray(),
        tipo_multa_id: ko.observable(null),
        no_multa: ko.observable(null)
    },

    multa: {
        causa_id: ko.observable(null),
        linea_chofer_id: ko.observable(null),
        total_a_pagar: ko.observable(null),
        observacion: ko.observable(null),
        causa: ko.observable(''),
        tipo_multa_id: ko.observable(null),
        no_multa: ko.observable(null)
    },

    transporte: {
        tipo:ko.observable(""),
        marca: ko.observable(""),
        modelo: ko.observable(""),
        placa: ko.observable(""),
        chasis: ko.observable(""),
        motor: ko.observable(""),
        color: ko.observable("")
    },

    inspeccions: ko.observableArray([]),
    tipos: ko.observableArray([]),
    transportes: ko.observableArray([]),
    causas: ko.observableArray([]),
    pilotos: ko.observableArray([]),
    agentes: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    viewInfo: ko.observable(false),
    applyMulta:ko.observable(false),


    //mapear funcion para editar
    map: function (data) {
        let self = model.inspeccionController;
        var form = model.inspeccionController.inspeccion;
        form.id(data.id);
        form.numero(data.numero);
        form.transporte_id(data.transporte_id);
        form.agente_id(data.agente_id);
        form.fecha(data.fecha);
        form.total_llantas(data.total_llantas);
        form.platos(data.platos);
        form.retrovisores(data.retrovisores);
        form.antena(data.antena);
        form.silvines(data.silvines);
        form.stops(data.stops);
        form.tricket(data.tricket);
        form.herramienta(data.herramienta);
        form.placas(data.placas);
        form.radio(data.radio);
        form.bocinas_radio(data.bocinas_radio);
        form.vidrios(data.vidrios);
        form.tapon_conbustible(data.tapon_conbustible);
        form.tapon_radiadior(data.tapon_radiadior);
        form.plumillas(data.plumillas);
        form.alfombras(data.alfombras);
        form.pidevias(data.pidevias);
        form.reproductor(data.reproductor);
        form.otros_accesorios(data.otros_accesorios);
        form.daños(data.daños);
        form.observacion(data.observacion);
        form.multasInfo(data.inspeccion_multas);
        form.causa_id(data.causa_id);
        form.observacion_multa(data.observacion_multa);
        form.total_a_pagar(data.total_a_pagar);
        form.agente(data.agente.nombre_uno+' '+data.agente.apellido_uno);
        self.setVehiculo(data.transporte_id);
    },

    view: function(data){
        let self = model.inspeccionController;
        self.viewInfo(true);
        self.gridMode(false);
        self.insertMode(false);
        self.editMode(false);
        self.map(data);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.inspeccionController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
       self.viewInfo(false);
    },

    clearData: function(){
       let self = model.inspeccionController;

        Object.keys(self.inspeccion).forEach(function(key,index) {
          if(typeof self.inspeccion[key]() === "string") 
            self.inspeccion[key]("")
          else if (typeof self.inspeccion[key]() === "boolean") 
            self.inspeccion[key](false)
          else if (typeof self.inspeccion[key]() === "number") 
            self.inspeccion[key](null)
        });

        self.inspeccion.multas([]);
        console.log(self.inspeccion);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.inspeccionController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
        self.viewInfo(false);
    },

    createOrEdit(){
        let self = model.inspeccionController;
     //validar formulario
        if (!model.validateForm('#inspeccionForm')) { 
            return;
        }

        self.inspeccion.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.inspeccionController;
        var data = self.inspeccion;
        var dataParams = ko.toJS(data);

        var exists= self.inspeccions().filter(x=>x.numero === parseInt(dataParams.numero));

        if(exists.length > 0){
            toastr.error('numero de inspeccion ya existe','error');
            return;
        }

        //llamada al servicio
        inspeccionService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.inspeccionController;
        var data = self.inspeccion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        inspeccionService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.inspeccionController;
        bootbox.confirm({ 
            title: "eliminar inspeccion",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    inspeccionService.destroy(data)
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
        let self = model.inspeccionController;
        self.returnGrid();

        model.clearErrorMessage('#inspeccionForm');
    },

    returnGrid(){
        let self = model.inspeccionController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.viewInfo(false);
        self.clearData();
        self.getAll();
    },

    getAll: function(){
        let self = model.inspeccionController;
         //llamada al servicio
        inspeccionService.getAll()
        .then(r => {
            self.inspeccions(r.data);
        })
        .catch(r => {});

    },

    getPersonas: function(){
        let self = model.inspeccionController;
         //llamada al servicio
        personaService.getAll()
        .then(r => {
            self.agentes([]);
            r.data.forEach(function(item){
                if(item.tipo_persona.nombre.substring(0,6).toLowerCase() == 'agente'){
                    self.agentes.push(item);
                }
            })
        })
        .catch(r => {});
    },

    getTransportes: function(){
        let self = model.inspeccionController;
         //llamada al servicio
        transporteService.getAll()
        .then(r => {
            r.data = r.data.filter(x=>x.actual);
            self.transportes(r.data);
        })
        .catch(r => {});
    },

    getCausas: function(){
        let self = model.inspeccionController;
         //llamada al servicio
        causaService.getAll()
        .then(r => {
            self.causas(r.data);
        })
        .catch(r => {});
    },

    getTipos: function(){
        let self = model.inspeccionController;
         //llamada al servicio
        tipoMultaService.getAll()
        .then(r => {
            self.tipos(r.data);
        })
        .catch(r => {});
    },

    addMulta: function(){
        let self = model.inspeccionController;

        if(self.inspeccion.tipo_multa_id() === null){
            toastr.error('seleccione tipo de multa', 'error');
        }

        if(self.inspeccion.causa_id() === null){
            toastr.error('seleccione causa', 'error');
        }

        if(self.inspeccion.no_multa() === null){
            toastr.error('escriba un numero de multa', 'error');
        }

        self.inspeccion.multas.push({
            causa_id: self.inspeccion.causa_id(),
            causa: self.inspeccion.causa(),
            total_a_pagar: self.inspeccion.total_a_pagar(),
            observacion: self.inspeccion.observacion(),
            tipo_multa_id: self.inspeccion.tipo_multa_id(),
            no_multa: self.inspeccion.no_multa()
        });
    },

    removeMulta: function(multa){
        let self = model.inspeccionController;
        var i = self.inspeccion.multas().indexOf(multa)
        self.inspeccion.multas.splice(i,1);
    },

    setVehiculo: function(){
        let self = model.inspeccionController;
        self.transportes().forEach(function(t){
            if(t.id === self.inspeccion.transporte_id()){
                self.mapVehiculo(t);
            }
        })
    },

     setCausa: function(){
        let self = model.inspeccionController;
        console.log(self.inspeccion.causa_id())
        self.causas().forEach(function(c){
            if(c.id === self.inspeccion.causa_id()){
                self.inspeccion.causa(c.nombre);
                self.inspeccion.total_a_pagar(c.monto.monto);
            }
        })
        console.log(self.inspeccion.causa());
    },

    mapVehiculo: function(transporte){
        let self = model.inspeccionController;
        self.transporte.placa(transporte.placa);
        self.transporte.marca(transporte.marca_transporte.nombre);
        self.transporte.tipo(transporte.linea.tipo_transporte.nombre);
        self.transporte.modelo(transporte.modelo);
        self.transporte.chasis(transporte.no_chasis);
        self.transporte.color(transporte.color);
        self.transporte.motor(transporte.no_motor);
    },


    initialize: function () {
        var self = model.inspeccionController;
        self.getAll();
        self.getPersonas();
        self.getTransportes();
        self.getCausas();
        self.getTipos();
    }
};