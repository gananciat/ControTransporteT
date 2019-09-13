propietarioLineaService = {
    getAll() {
        return axios.get(`propietarioLineas`);
    },

    get(id) {
        let self = this;
        return axios.get(`propietarioLineas/${id}`);
    },

    create(data) {
        return axios.post(`propietarioLineas`, data);
    },

    update(data) {
        return axios.put(`propietarioLineas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`propietarioLineas/${data.id}`);
    }

}