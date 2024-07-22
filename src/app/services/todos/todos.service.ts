import queryString from 'query-string';
import {request} from "@app/instances";
import {HTMLResponseType, TodosType} from "@app/types";
import {IAddOptions, IAddParams} from "./todos.types.ts";
import {JSON_PLACEHOLDER_URL} from "@app/configs/server.ts";
export const TodosService = {
    async sendTodos(todos: TodosType) {
        const formData = new FormData();

        formData.append('action', 'send_todos');
        formData.append('todos', JSON.stringify(todos));

        return request<string>({
            method: 'POST',
            data: formData
        })
    },
    async receiveTodos() {
        const formData = new FormData()
        formData.append('action', 'receive_todos');

        return request<TodosType>({
            method: 'POST',
            data: formData
        })
    },
    async htmlTodos(todos: TodosType) {
        const formData = new FormData();

        formData.append('action', 'html_todos');
        formData.append('todos', JSON.stringify(todos));

        return request<HTMLResponseType>({
            method: 'POST',
            data: formData
        })
    },
    async addTodos(options: IAddOptions) {
        const params: IAddParams = {
            _start: 1,
            _limit: 3,
            ...options
        }

        return request<TodosType>({
            method: 'GET',
            url: JSON_PLACEHOLDER_URL + queryString.stringify(params)
        })
    }
}