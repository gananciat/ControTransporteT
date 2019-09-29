model.lineaChoferController = {

    lineaChofer: {
        id: ko.observable(null),
        linea_id: ko.observable(null),
        chofer_id: ko.observable(null),
        tipo_chofer: ko.observable(null),
    },

    lineaChofers: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    tipos: [{ nombre: 'Titular', valor: 'T' }, { nombre: 'Suplente', valor: 'S' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.lineaChoferController.lineaChofer;
        form.id(data.id);
        form.linea_id(data.linea_id);
        form.chofer_id(data.chofer_id);
        form.tipo_chofer(data.tipo_chofer);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.lineaChoferController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.lineaChoferController;

        Object.keys(self.lineaChofer).forEach(function(key,index) {
          if(typeof self.lineaChofer[key]() === "string") 
            self.lineaChofer[key]("")
          else if (typeof self.lineaChofer[key]() === "boolean") 
            self.lineaChofer[key](true)
          else if (typeof self.lineaChofer[key]() === "number") 
            self.lineaChofer[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.lineaChoferController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.lineaChoferController;
     //validar formulario
        if (!model.validateForm('#lineaChoferForm')) { 
            return;
        }

        self.lineaChofer.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.lineaChoferController;
        var data = self.lineaChofer;
        var dataParams = ko.toJS(data);

        if(self.validateExistencia(dataParams.chofer_id, dataParams.tipo_chofer)){
            toastr.error("piloto seleccionado ya esa designado a linea",'return');
            return;
        }

        //llamada al servicio
        lineaChoferService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid(dataParams.linea_id);  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    validateExistencia(chofer_id, tipo){
        let self = this;
        var existe= false;
        self.lineaChofers().forEach(function(item){
            if(item.chofer_id === chofer_id && item.actual && item.tipo_chofer === tipo){
                existe = true;
            }
        });

        return existe;
    },

     update: function () {
        let self = model.lineaChoferController;
        var data = self.lineaChofer;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        lineaChoferService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid(dataParams.linea_id);
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.lineaChoferController;
        bootbox.confirm({ 
            title: "eliminar lineaChofer",
            message: "¿Esta seguro que quiere eliminar propietario?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    lineaChoferService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.returnGrid(data.linea_id);
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    cancelar: function () {
        let self = model.lineaChoferController;
        self.returnGrid();

        model.clearErrorMessage('#lineaChoferForm');
    },

    returnGrid(linea_id){
        let self = model.lineaChoferController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize(linea_id)
    },

    initialize: function (linea_id) {
        var self = model.lineaChoferController;
        self.lineaChofer.linea_id(linea_id);

        //llamada al servicio
        lineaService.getChoferes(linea_id)
        .then(r => {
            self.lineaChofers(r.data);
        })
        .catch(r => {});
    }
};