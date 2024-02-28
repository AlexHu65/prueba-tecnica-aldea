
// this service is required on root to get token
export const getToken = () => localStorage.getItem('token');

export const removeToken = () => localStorage.getItem('token');

export const setToken = (token) => localStorage.setItem('token' , token);
