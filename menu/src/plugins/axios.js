import axios from "axios"
import store from "@/store"
import router from "@/routes"

const instance = axios.create({
    baseURL: import.meta.env.VITE_APP_BASE_API_URL,
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    }
});

instance.defaults.headers.common['Authorization'] = "Bearer "+localStorage.getItem("access_token");
// instance.defaults.withCredentials = true;

instance.interceptors.response.use(
  function (response) {
    // Success
    // instance.defaults.headers.common['Authorization'] = "Bearer "+localStorage.getItem("access_token");
    return response;
  }, 
  function (error) {
    
    if (error.response) {
        // status, data
        if ( error.response.status == 401 ) {
          store.commit("auth/logout")
          router.push({name: "login"})
        }
        console.log(error.response)
    }
    return Promise.reject(error);
  });

export default instance;