import { client } from "./jsonClient"; 

export default {
    post(uri, data) {
      return client.post(uri, data);
    },
    delete(uri) {
      return client.delete(uri);
    },
    put(uri, data) {
        return client.put(uri, data);
    },
    get(uri) {
        return client.get(uri);
    }
  }