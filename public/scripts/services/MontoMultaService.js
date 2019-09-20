montoMultaService = {
    getAll() {
        return axios.get(`montoMultas`);
    },

    get(id) {
        let self = this;
        return axios.get(`montoMultas/${id}`);
    },

    create(data) {
        return axios.post(`montoMultas`, data);
    },

    update(data) {
        return axios.put(`montoMultas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`montoMultas/${data.id}`);
    }

}