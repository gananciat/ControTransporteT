model.propietarioLineaController = {

    propietarioLinea: {
        id: ko.observable(null),
        linea_id: ko.observable(null),
        propietario_id: ko.observable(null)
    },

    propietarioLineas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.propietarioLineaController.propietarioLinea;
        form.id(data.id);
        form.linea_id(data.linea_id);
        form.propietario_id(data.propietario_id);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.propietarioLineaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.propietarioLineaController;

        Object.keys(self.propietarioLinea).forEach(function(key,index) {
          if(typeof self.propietarioLinea[key]() === "string") 
            self.propietarioLinea[key]("")
          else if (typeof self.propietarioLinea[key]() === "boolean") 
            self.propietarioLinea[key](true)
          else if (typeof self.propietarioLinea[key]() === "number") 
            self.propietarioLinea[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.propietarioLineaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.propietarioLineaController;
     //validar formulario
        if (!model.validateForm('#propietarioLineaForm')) { 
            return;
        }

        self.propietarioLinea.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.propietarioLineaController;
        var data = self.propietarioLinea;
        var dataParams = ko.toJS(data);

        if(self.validateExistencia(dataParams.propietario_id)){
            toastr.error("propietario seleccionado es el actual dueño de licencia",'return');
            return;
        }

        //llamada al servicio
        propietarioLineaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid(dataParams.linea_id);  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    validateExistencia(propietario_id){
        let self = this;
        var existe= false;
        self.propietarioLineas().forEach(function(item){
            if(item.propietario_id === propietario_id && item.actual){
                existe = true;
            }
        });

        return existe;
    },

     update: function () {
        let self = model.propietarioLineaController;
        var data = self.propietarioLinea;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        propietarioLineaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid(dataParams.linea_id);
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.propietarioLineaController;
        bootbox.confirm({ 
            title: "eliminar propietarioLinea",
            message: "¿Esta seguro que quiere eliminar propietario?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    propietarioLineaService.destroy(data)
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
        let self = model.propietarioLineaController;
        self.returnGrid();

        model.clearErrorMessage('#propietarioLineaForm');
    },

    returnGrid(linea_id){
        let self = model.propietarioLineaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize(linea_id)
    },

    initialize: function (linea_id) {
        var self = model.propietarioLineaController;
        self.propietarioLinea.linea_id(linea_id);

        //llamada al servicio
        lineaService.getPropietarios(linea_id)
        .then(r => {
            self.propietarioLineas(r.data);
        })
        .catch(r => {});
    }
};