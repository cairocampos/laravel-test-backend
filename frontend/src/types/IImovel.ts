export interface IImovel {
    id?:number;
    bairro:string;
    cep:string;
    rua:string;
    cidade:string;
    estado:string;
    complemento?:string;
    numero:string;
    cor:string;
    email_proprietario:string;
    total_divisoes:number|string;
}