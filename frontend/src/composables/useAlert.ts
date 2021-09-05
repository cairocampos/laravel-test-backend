import Swal, {SweetAlertIcon, SweetAlertOptions} from 'sweetalert2';
import { AxiosError } from 'axios';

export default function useAlert() {
    function alert(title:string, text:string, icon:SweetAlertIcon, isHtml = false) {
        const sweet: SweetAlertOptions = {
            title,
            icon
        }

        if(isHtml)
            sweet.html = text
        else
            sweet.text = text;

        Swal.fire(sweet);
    }

    function successAlert(text:string) {
        alert("Sucesso!", text, "success");
    }

    function errorAlert(error:AxiosError) {
        let text = getMessage(error);
        if(!text || text == ""){
            text = "Algo deu errado na sua solicitação, por favor atualize sua pagina e tente novamente.";
        }
        return alert("Oops", text, "error", true);
    }

    function warningAlert(text:string) {
        alert("Aviso!", text, "warning")
    }

    function infoAlert(text:string) {
        alert("", text, "info");
    }

    function confirmAlert(text:string, callback:any) {
        Swal.fire({
            title: 'Atenção!',
            text,
            icon:"question",
            showCancelButton: true,
            confirmButtonText: "Sim",
            cancelButtonText:"Cancelar"
        }).then(callback);
    }


    function getMessage(error: AxiosError): string {
        if(error && error.response) {
            if(error.response.data.errors) {
                let html = '<ul>';
                const errors =  Object.values<string[]>(error.response.data.errors).map((erro: string[]) => {
                    return erro[0];
                });

                errors.forEach((erro) => {
                    html += `<li style="margin-bottom:8px;">${erro}</li>`;
                });
                html += '</ul>';
                return html;
            }

            return error.response.data.message ?? error.response.statusText
        }

        return "Não conseguimos realizar sua solicitação, por favor atualize sua página e tente novamente.";
    }

    return {
        alert,
        successAlert,
        warningAlert,
        infoAlert,
        confirmAlert,
        errorAlert
    }
}