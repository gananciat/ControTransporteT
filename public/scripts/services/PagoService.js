pagoService = {
    getAll() {
        return axios.get(`pagos`);
    },

    get(id) {
        let self = this;
        return axios.get(`pagos/${id}`);
    },

    create(data) {
        return axios.post(`pagos`, data);
    },

    update(data) {
        return axios.put(`pagos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`pagos/${data.id}`);
    },

    anular(data) {
        return axios.put(`pagos_anular/${data.id}`);
    },

}