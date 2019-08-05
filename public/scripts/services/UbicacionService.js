ubicacionService = {
    getAll() {
        return axios.get(`ubicacions`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`ubicacions/${id}`);
    },

    create(data) {
        return axios.post(`ubicacions`, data);
    },

    update(data) {
        return axios.put(`ubicacions/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`ubicacions/${data.id}`);
    }

}