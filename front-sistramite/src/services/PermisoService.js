import { api } from "src/boot/axios";

class PermisoService {
    static async getData(params) {
        return (await api.get('/api/permisos',params)).data;
    }

    static async get(id) {
        return (await api.get(`/api/permisos/${id}`)).data;
    }

    static async delete(id) {
        return (await api.delete(`/api/permisos/${id}`));
    }

    static async save(reg) {
        if (reg.id === undefined || reg.id === null) {
            return (await api.post("/api/permisos", reg)).data;
        } else {
            return (await api.put(`/api/permisos/${reg.id}`, reg)).data;
        }
    }
}

export default PermisoService;
