//controller que se encarga de interactuar con la vista y con los servicios axios
model.expedienteController = {

    expediente: {
        id: ko.observable(null),
        expediente: ko.observable(""),
        propietario_id: ko.observable(null),
        anio_id: ko.observable(null)
    },

    expedientes: ko.observableArray([]),
    anios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.expedienteController.expediente;
        form.id(data.id);
        form.propietario_id(data.propietario_id);
        form.anio_id(data.anio_id);
        form.expediente(data.expediente);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.expedienteController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
       let self = model.expedienteController;

       let form = self.expediente;
       form.anio_id(null);
       form.expediente("");
       document.getElementById("expediente_doc").value = "";
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.expedienteController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.expedienteController;
     //validar formulario
        if (!model.validateForm('#form_exp')) { 
            return;
        }

        self.expediente.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.expedienteController;
        var data = self.expediente;
        var dataParams = ko.toJS(data);

        dataParams.expediente = document.getElementById('expediente_doc').files[0];
        // input where the files were uploaded to
        var formData = self.getFormData(dataParams);

        //llamada al servicio
        expedienteService.create(formData)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
           $('#expediente').modal('hide'); 
           self.clearData();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    getFormData: function(object) {
        const formData = new FormData();
        Object.keys(object).forEach(key => formData.append(key, object[key]));
        return formData;
    },

    /*funcion para actualizar registro
     update: function () {
        let self = model.expedienteController;
        var data = self.expediente;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        expedienteService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },*/

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.expedienteController;
        bootbox.confirm({ 
            title: "eliminar expediente",
            message: "¿Esta seguro que quiere eliminar expediente" + data.id + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    expedienteService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.initialize(data.propietario_id);
                        self.clearData();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

//funcion para cancelar registro
    cancelar: function () {
        let self = model.expedienteController;
        self.clearData();

        model.clearErrorMessage('#form_exp');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(propietario_id){
        let self = model.expedienteController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.clearData();
        self.initialize(propietario_id);
    },

    getAnios: function(){
        let self = model.expedienteController;
        //llamada al servicio
        anioService.getAll()
        .then(r => {
            self.anios(r.data);
        })
        .catch(r => {});
    },

    //expedienteumento, preview
    setExpediente: function () {
        let self = model.expedienteController;
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("expediente_doc").files[0]);

        oFReader.onload = function (oFREvent) {
            //self.expediente.expediente = oFREvent.target.result;
        };
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function (propietario_id) {
        var self = model.expedienteController;
        self.expediente.propietario_id(propietario_id);

        //llamada al servicio
        personaService.getExpedientes(propietario_id)
        .then(r => {
            self.expedientes(r.data);
        })
        .catch(r => {});

        self.getAnios();
    }
};