anioService = {
    getAll() {
        return axios.get(`anios`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`anios`, data);
    },

    update(data) {
        return axios.put(`anios/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`anios/${data.id}`);
    }

}