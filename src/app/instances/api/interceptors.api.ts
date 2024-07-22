import axios from 'axios'
import { ADMIN_AJAX_URL } from '@app/configs'

const instance = axios.create({
    baseURL: ADMIN_AJAX_URL
})
export default instance
