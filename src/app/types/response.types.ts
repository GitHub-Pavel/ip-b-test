export type HTMLResponseType = string;
export interface IAdminAjaxResponse<T> {
    data: T;
    success: boolean;
}