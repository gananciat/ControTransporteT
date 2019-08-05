conceptoPagoService = {
    getAll() {
        return axios.get(`conceptoPagos`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`conceptoPagos`, data);
    },

    update(data) {
        return axios.put(`conceptoPagos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`conceptoPagos/${data.id}`);
    }

}