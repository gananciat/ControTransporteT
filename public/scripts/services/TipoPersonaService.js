tipoPersonaService = {
    getAll() {
        return axios.get(`tipoPersonas`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`tipoPersonas`, data);
    },

    update(data) {
        return axios.put(`tipoPersonas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`tipoPersonas/${data.id}`);
    }

}