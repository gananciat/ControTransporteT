personaService = {
    getAll(tipo_id) {
        if(tipo_id !== null && tipo_id !== undefined){
            return axios.get(`personas?tipo_persona_id=${tipo_id}`)
        }
        return axios.get(`personas`);
    },

    get(id) {
        let self = this;
        return axios.get(`personas/${id}`);
    },

    getExpedientes(id) {
        let self = this;
        return axios.get(`personas/${id}/expedientes`);
    },

    getPagos(id) {
        let self = this;
        return axios.get(`personas/${id}/pagos`);
    },

    getLineas(id) {
        let self = this;
        return axios.get(`personas/${id}/lineas`);
    },

    create(data) {
        return axios.post(`personas`, data);
    },

    update(data) {
        return axios.put(`personas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`personas/${data.id}`);
    }

}