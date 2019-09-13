lineaChoferService = {
    getAll() {
        return axios.get(`lineaChofers`);
    },

    get(id) {
        let self = this;
        return axios.get(`lineaChofers/${id}`);
    },

    create(data) {
        return axios.post(`lineaChofers`, data);
    },

    update(data) {
        return axios.put(`lineaChofers/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`lineaChofers/${data.id}`);
    }

}