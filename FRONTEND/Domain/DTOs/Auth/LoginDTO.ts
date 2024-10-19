export class LoginDTO {
    email: string;
    password: string;

    constructor(login: any = null) {
        this.email = login?.email ?? '';
        this.password = login?.password ?? '';
    }

    toFormData() {
        const formdata = new FormData();

        formdata.append("email", this.email ?? '');
        formdata.append("password", this.password ?? '');

        return formdata;
    }


}