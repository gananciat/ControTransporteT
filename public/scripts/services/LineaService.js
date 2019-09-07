lineaService = {
    getAll() {
        return axios.get(`lineas`);
    },

    get(id) {
        let self = this;
        return axios.get(`lineas/${id}`);
    },

    create(data) {
        return axios.post(`lineas`, data);
    },

    update(data) {
        return axios.put(`lineas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`lineas/${data.id}`);
    }

}