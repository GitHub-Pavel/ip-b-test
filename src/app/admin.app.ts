import {TodosService} from "@app/services";
import {SearchComponent, TodosComponent} from "@app/components";
import {effectTodo} from "@app/utils/effects.ts";
import Toastify from "toastify-js";


window.addEventListener('DOMContentLoaded', async () => {
    const form = document.getElementById('todos-form') as HTMLFormElement | null

    if (!form) return;

    const todosComponent = new TodosComponent()
    const list = document.getElementById('todos-list')

    TodosService.receiveTodos().then(todos => todosComponent.setTodos(todos))
    todosComponent.addEffect(async () => {
        list.innerHTML = await TodosService.htmlTodos(todosComponent.todos)
    })

    new SearchComponent('todos-search', {
        onSearch: async (value) => {
            const todos = todosComponent.todos.filter(({title}) => title.includes(value));
            list.innerHTML = await TodosService.htmlTodos(todos)
        },
        onOutLength: async () => {
            list.innerHTML = await TodosService.htmlTodos(todosComponent.todos)
        }
    })

    const loadHandle = async (e: WindowEventMap['click']) => {
        e.preventDefault();
        const todos = await TodosService.addTodos({
            _start: todosComponent.todos.length
        })
        todosComponent.setTodos([...todosComponent.todos, ...todos])
    }

    const submitHandle = async (e: WindowEventMap['submit']) => {
        e.preventDefault();
        const text = await TodosService.sendTodos(todosComponent.todos)
        Toastify({
            text,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            duration: 2000,
            style: {
                background: "#22bb33",
            }
        }).showToast()
    }

    form.addEventListener('submit', submitHandle)
    window.addEventListener('change', effectTodo(todosComponent))
    document.getElementById('load-todos').addEventListener('click', loadHandle)
})