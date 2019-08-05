tipoUsuarioService = {
    getAll() {
        return axios.get(`tipoUsuarios`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`tipoUsuarios`, data);
    },

    update(data) {
        return axios.put(`tipoUsuarios/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`tipoUsuarios/${data.id}`);
    }

}