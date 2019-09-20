multaService = {
    getAll() {
        return axios.get(`multas`);
    },

    get(id) {
        let self = this;
        return axios.get(`multas/${id}`);
    },

    create(data) {
        return axios.post(`multas`, data);
    },

    update(data) {
        return axios.put(`multas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`multas/${data.id}`);
    }

}