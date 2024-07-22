import {AxiosError} from "axios";

export type TErrorCatch = AxiosError<{
    data?: {
        message: string;
    },
    success: boolean;
} | null>
