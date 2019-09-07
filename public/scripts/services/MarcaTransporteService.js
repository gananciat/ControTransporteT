marcaTransporteService = {
    getAll() {
        return axios.get(`marcaTransportes`);
    },

    get(id) {
        let self = this;
        return axios.get(`marcaTransportes/${id}`);
    },

    create(data) {
        return axios.post(`marcaTransportes`, data);
    },

    update(data) {
        return axios.put(`marcaTransportes/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`marcaTransportes/${data.id}`);
    }

}