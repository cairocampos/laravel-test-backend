import { IImovel } from "@/types/IImovel";

export default function useEndereco() {
    const formataEndereco = (imovel: IImovel) => {
        return `${imovel.rua}, ${imovel.numero}, ${imovel.cidade}, ${imovel.estado}`;
    }


    return {
        formataEndereco
    }
}