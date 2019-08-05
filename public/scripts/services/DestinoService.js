destinoService = {
    getAll() {
        return axios.get(`destinos`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`destinos`, data);
    },

    update(data) {
        return axios.put(`destinos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`destinos/${data.id}`);
    }

}