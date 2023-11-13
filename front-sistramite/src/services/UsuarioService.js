import { api } from "src/boot/axios";

class UsuarioService {
  static async getData(params) {
    return (await api.get("api/usuarios", params)).data;
  }

  static async get(id, permisos) {
    if (permisos) {
      return (
        await api.get(`api/usuarios/${id}`, {
          params: { permisos: permisos },
        })
      ).data;
    } else {
      return (await api.get(`api/usuarios/${id}`)).data;
    }
  }

  static async save(reg) {
    if (reg.id === undefined || reg.id === null) {
      return (await api.post("api/usuarios", reg)).data;
    } else {
      return (await api.put(`api/usuarios/${reg.id}`, reg)).data;
    }
  }

  static async updateUserPermisos(reg) {
    return (await api.put(`api/updateUserPermisos/${reg.id}`, reg)).data;
  }

  static async delete(id) {
    return (await api.delete(`api/usuarios/${id}`)).data;
  }
}

export default UsuarioService;
