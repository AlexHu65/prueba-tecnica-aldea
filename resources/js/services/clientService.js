import axios from "axios";
import { config, env } from "../config/main";
import { getToken } from "../services/mainService";

const setUrl = () => (env.prod ? config.prodApiUrl : config.devApiUrl);

export const client = axios.create({
  baseURL: setUrl(),
  headers: {
    'Content-Type': 'multipart/form-data',
    'Accept' : 'application/json',
    'Authorization': `Bearer ${getToken()}`
  }
});