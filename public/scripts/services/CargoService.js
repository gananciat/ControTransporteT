cargoService = {
    getAll() {
        return axios.get(`cargos`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`cargos/${id}`);
    },

    create(data) {
        return axios.post(`cargos`, data);
    },

    update(data) {
        return axios.put(`cargos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`cargos/${data.id}`);
    }

}