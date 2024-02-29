import { client } from "./clientService"; 

export default {
    post(uri, data) {
      return client.post(uri, data);
    },
    get(uri) {
        return client.get(uri);
    }
  }