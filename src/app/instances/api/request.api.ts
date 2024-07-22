import { AxiosRequestConfig, AxiosResponse } from 'axios'
import Toastify from 'toastify-js'
import { debounce } from 'lodash'

import { TErrorCatch } from './api.types.ts'
import instance from './interceptors.api.ts'
import {IAdminAjaxResponse} from "@app/types";

const debounceError = debounce((text: string) => Toastify({
    text,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    duration: 2000,
    style: {
        background: "#FF3333",
    },
}).showToast(), 400)

export const request = async <T>(config: AxiosRequestConfig) => {
    const onSuccess = (response: AxiosResponse<IAdminAjaxResponse<T>>) => {
        const { data } = response
        if (data.data) return data.data
        return data as T
    }

    const onError = (error: TErrorCatch) => {
        debounceError(error.response?.data?.data?.message || error.message)
        return Promise.reject(error)
    }

    return instance(config).then(onSuccess).catch(onError)
}
