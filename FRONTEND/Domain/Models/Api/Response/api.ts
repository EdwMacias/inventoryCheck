export interface Response<T>{
    messages : string | Array<string>,
    data : T,
    code : number
}