
// this service is required on root to get token
export const getToken = () => localStorage.getItem('token');

export const removeToken = () => localStorage.removeItem('token');

export const setToken = (token) => localStorage.setItem('token' , token);
