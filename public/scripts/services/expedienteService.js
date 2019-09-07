//servicios con axios para consumir controladores
expedienteService = {
    //peticion a funcion index
    getAll() {
        return axios.get(`expedientes`);
    },

    //peticion a funcion show
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    //peticion a funcion create
    create(data) {
        return axios.post(`expedientes`, data,
            { headers: 
                {'Content-Type': 'multipart/form-data' }
            }
        );
    },

    //peticion a funcion update
    update(data) {
        return axios.put(`expedientes/${data.id}`,data);
    },

    //peticion a funcion destroy
    destroy(data){
        return axios.delete(`expedientes/${data.id}`);
    }

}