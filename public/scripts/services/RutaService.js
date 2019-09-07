rutaService = {
    getAll() {
        return axios.get(`rutas`);
    },

    get(id) {
        let self = this;
        return axios.get(`rutas/${id}`);
    },

    create(data) {
        return axios.post(`rutas`, data);
    },

    update(data) {
        return axios.put(`rutas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`rutas/${data.id}`);
    }

}