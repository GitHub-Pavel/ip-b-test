import {TodosType} from "@app/types";

export class TodosComponent {
    private effectsCallback: Array<() => void> = [];

    public todos: TodosType = [];

    setTodos(todos: TodosType) {
        this.todos = todos;
        this.effect()
    }

    addEffect(callback: () => void) {
        this.effectsCallback.push(callback);
    }

    effect() {
        this.effectsCallback.map(callback => callback());
    }
}