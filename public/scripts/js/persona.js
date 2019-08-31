//controller que se encarga de interactuar con la vista y con los servicios axios
model.personaController = {
    persona: {
        id: ko.observable(null),
        cui: ko.observable(""),
        nombre_uno: ko.observable(""),
        nombre_dos: ko.observable(""),
        apellido_uno: ko.observable(""),
        apellido_dos: ko.observable(""),
        fecha_nac: ko.observable(""),
        email: ko.observable(""),
        foto: ko.observable(""),
        estado: ko.observable(true),
        direccion: ko.observable(''),
        telefono: ko.observable(''),
        telefonos: ko.observableArray([]),
        image_file: ko.observable(""),
        tipo_persona_id: ko.observable(null),
    },

    personas: ko.observableArray([]),
    tipo_personas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    selectTipo: ko.observable(false),
    persona_name: ko.observable(''),


    //mapear funcion para editar
    map: function (data) {
        let self = model.personaController;
        var form = self.persona;
        form.id(data.id);
        form.cui(data.cui);
        form.nombre_uno(data.nombre_uno);
        form.nombre_dos(data.nombre_dos);
        form.apellido_uno(data.apellido_uno);
        form.apellido_dos(data.apellido_dos);
        form.email(data.email);
        form.telefonos(data.telefonos);
        form.direccion(data.direccion);
        form.foto(data.foto);
        form.fecha_nac(data.fecha_nac);
        form.tipo_persona_id(data.tipo_persona_id);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.personaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    //limpiar formulario
    clearData: function(){
        let self = model.personaController;
        var form = self.persona;
        form.id(null);
        form.cui("");
        form.nombre_uno("");
        form.nombre_dos("");
        form.apellido_uno("");
        form.apellido_dos("");
        form.email("");
        form.telefonos([]);
        form.direccion("");
        form.estado(true);
        form.foto("");
        $("#foto").val(null);
    },


   //editar registros del formulario
    editar: function (data){
        let self = model.personaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
        let self = model.personaController;
                if(self.persona.telefonos().length === 0){
            toastr.error("debe ingresar al menos un numero de teléfono","error");
            return
        }
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.persona.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.personaController;
        var data = self.persona;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        personaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.volverIndex(); 
            self.getTipoPersonas();
            self.getAll(dataParams.tipo_persona_id); 
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar registro
     update: function () {
        let self = model.personaController;
        var data = self.persona;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        personaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.volverIndex();
            self.getTipoPersonas();
            self.getAll(dataParams.tipo_persona_id);
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.personaController;
        bootbox.confirm({ 
            title: "eliminar persona",
            message: "¿Esta seguro que quiere eliminar " + data.cui + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    personaService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.volverIndex();
                        self.getTipoPersonas();
                        self.getAll(data.tipo_persona_id);
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    //funcion para eliminar registro
    cambiarEstado: function (data) {
        let self= model.personaController;
        var title = data.estado ? 'desactivar' : 'activar';
        data.estado = !data.estado;

        bootbox.confirm({ 
            title: title+" persona",
            message: "¿Esta seguro que quiere " +title+' ' +data.nombre_uno +' '+data.nombre_dos +"?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    personaService.cambiarEstado(data)
                    .then(r => {
                        toastr.info("registro actualizado con éxito",'éxito');
                        self.volverIndex();
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
        let self = model.personaController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.personaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
    },

    //image user profile
    PreviewAvatar: function () {
        let self = model.personaController;
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("foto").files[0]);

        oFReader.onload = function (oFREvent) {
            self.persona.image_file = oFREvent.target.result;
            document.getElementById("previewFoto").src = oFREvent.target.result;
        };
    },

    addTelefono(){
        let self = model.personaController;
        var numero = self.persona.telefono();
        self.persona.telefonos.push({telefono: numero});
        self.persona.telefono("")
    },

    removeTelefono(telefono){
        let self = model.personaController
        var i = self.persona.telefonos().indexOf(telefono);
        self.persona.telefonos.splice(i,1);
    },

    getTipoPersonas: function(){
        let self = model.personaController;
        //llamada al servicio
        tipoPersonaService.getAll()
        .then(r => {
            self.tipo_personas(r.data);
        })
        .catch(r => {});
    },

    selectTipoPersona(tipo){
        let self = model.personaController;
        self.selectTipo(true);
        self.persona.tipo_persona_id(tipo.id);
        self.persona_name(tipo.nombre);
        self.getAll(tipo.id);  
    },

    getAll: function(tipo_id){
        var self = model.personaController;

        personaService.getAll(tipo_id)
        .then(r => {
            self.personas(r.data);
        })
        .catch(r => {});
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        let self = model.personaController;
        self.getTipoPersonas();
    }
};
