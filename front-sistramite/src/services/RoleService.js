import { api } from "src/boot/axios";

class RoleService {
  static async getData(params) {
    return (await api.get("api/roles", params)).data;
  }

  static async getPermissions() {
    return (await api.get("api/permissions")).data;
  }

  static async get(id) {
    return (await api.get(`api/roles/${id}`)).data;
  }

  static async save(reg) {
    if (reg.id === undefined || reg.id === null) {
      return (await api.post("api/roles", reg)).data;
    } else {
      return (await api.put(`api/roles/${reg.id}`, reg)).data;
    }
  }

  static async delete(id) {
    return await api.delete(`api/roles/${id}`);
  }
}

export default RoleService;
