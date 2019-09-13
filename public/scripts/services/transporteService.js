transporteService = {
    getAll() {
        return axios.get(`transportes`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`transportes`, data);
    },

    update(data) {
        return axios.put(`transportes/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`transportes/${data.id}`);
    }

}