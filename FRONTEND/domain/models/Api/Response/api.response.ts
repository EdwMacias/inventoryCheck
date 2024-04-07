export interface Response<T>{
    message : string | Array<string>,
    data : T,
    code : number
}