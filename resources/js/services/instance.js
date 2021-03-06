import axios from 'axios'

const instance = axios.create({
  baseURL: process.env.MIX_API_URL,
  timeout: 30000
});

export default instance;