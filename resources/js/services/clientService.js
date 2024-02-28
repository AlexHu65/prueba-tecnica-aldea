import axios from "axios";
import  { config, env } from "../config/main";

const setUrl = () => (env.prod ? config.prodApiUrl : config.devApiUrl);

export const client = axios.create({
    baseURL: setUrl(),
    headers: {
    'Content-Type': 'multipart/form-data'
    }
});
/*
headers: {
    'Content-Type': 'multipart/form-data',
    'Authorization': `Bearer ${getToken}`
  }*/