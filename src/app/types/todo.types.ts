export interface ITodo {
    id: number;
    title: string;
    userId: number;
    completed: boolean;
}

export type TodosType = ITodo[]