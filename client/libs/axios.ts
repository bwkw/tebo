import Axios from 'axios'

export const axios = Axios.create({
  baseURL: process.browser ? 'http://localhost:80' : 'http://web:80',
  headers: { 'X-Requested-With': 'XMLHttpRequest' },
  withCredentials: true,
})
