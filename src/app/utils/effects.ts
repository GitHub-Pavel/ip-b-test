import {TodosComponent} from "@app/components";

export const effectTodo = (todosComponent: TodosComponent) => (e: WindowEventMap['change']) => {
    const checkbox = e.target as HTMLInputElement

    if (checkbox.name === 'todo') {
        for (const todo of todosComponent.todos) {
            if (todo.id === +checkbox.value) {
                todo.completed = checkbox.checked
            }
        }
    }

    if (checkbox.name === 'todos-all') {
        const checkboxes = document.querySelectorAll('input[name=todo]') as HTMLInputElement[]
        const ids = Object.values(checkboxes).map(checkbox => +checkbox.value);
        for (const todo of todosComponent.todos) {
            if (ids.includes(todo.id)) {
                todo.completed = checkbox.checked
            }
        }
    }
}