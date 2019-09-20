causaService = {
    getAll() {
        return axios.get(`causas`);
    },

    get(id) {
        let self = this;
        return axios.get(`causas/${id}`);
    },

    create(data) {
        return axios.post(`causas`, data);
    },

    update(data) {
        return axios.put(`causas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`causas/${data.id}`);
    }

}