tipoMultaService = {
    getAll() {
        return axios.get(`tipoMultas`);
    },

    get(id) {
        let self = this;
        return axios.get(`tipoMultas/${id}`);
    },

    create(data) {
        return axios.post(`tipoMultas`, data);
    },

    update(data) {
        return axios.put(`tipoMultas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`tipoMultas/${data.id}`);
    }

}