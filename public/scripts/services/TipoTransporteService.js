tipoTransporteService = {
    getAll() {
        return axios.get(`tipoTransportes`);
    },

    get(id) {
        let self = this;
        return axios.get(`tipoTransportes/${id}`);
    },

    create(data) {
        return axios.post(`tipoTransportes`, data);
    },

    update(data) {
        return axios.put(`tipoTransportes/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`tipoTransportes/${data.id}`);
    }

}