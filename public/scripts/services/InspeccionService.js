inspeccionService = {
    getAll() {
        return axios.get(`inspeccions`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`inspeccions`, data);
    },

    update(data) {
        return axios.put(`inspeccions/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`inspeccions/${data.id}`);
    }

}