import axios from "axios"

const instance = axios.create({
    baseURL: process.env.VITE_APP_BASE_API_URL+'/api/v1/',
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    }
});

instance.defaults.headers.common['Authorization'] = "Bearer "+localStorage.getItem("access_token");

instance.interceptors.response.use(
  function (response) {
    // Success
    // instance.defaults.headers.common['Authorization'] = "Bearer "+localStorage.getItem("access_token");
    return response;
  }, 
  function (error) {
    
    return Promise.reject(error);
  });

export default instance;