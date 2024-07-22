import {debounce} from "lodash";

type Options = {
    onOutLength: () => void,
    onSearch: (value: string) => void
}

export class SearchComponent {
    private input: HTMLInputElement;
    private options: Options;

    private isOutLen: boolean = true;

    private value: string;
    private readonly setValue: (value: string) => void;
    constructor(inputId: string, options: Options) {
        this.options = options
        this.input = document.getElementById(inputId) as HTMLInputElement
        this.value = this.input.value;
        this.input.addEventListener('input', this.handle.bind(this))
        this.setValue = debounce((value: string) => {
            this.value = value
            this.onInput()
        }, 300)
    }

    handle() {
        this.setValue(this.input.value)
    }

    onInput() {
        if (this.value.length < 3 && !this.isOutLen) {
            this.options.onOutLength()
            this.isOutLen = true
            return
        }

        if (this.value.length < 3) return

        this.options.onSearch(this.value)
        this.isOutLen = false
    }
}