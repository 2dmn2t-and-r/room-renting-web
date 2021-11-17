import axios from "axios";

const baseURL = "http://localhost:80/";

export const getDataAPI = async(url, token) => {
    const res = await axios.get(`${baseURL}${url}`, {
        headers: { Authorization: `${token}` }
    });
    return res;
}

export const postDataAPI = async(url, post, token) => {
    url = baseURL + url;
    const res = await axios.post(`${url}`, post, {
        headers: { Authorization: token }
    })
    return res;
}