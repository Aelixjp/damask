import { serverHost } from "../globals/utils/utils.js";
import LoadingComponent from "../components/loader/main.js";

$(document).ready(() => {
    const inpUsername = $("#inpUsername");
    const btnRecoverPass = $("#btnRecoverPass"   );
    const formRecoverPassword = $("#formRecoverPassword");
    const loading = new LoadingComponent();

    $(window).on("keyup", ev => {
        if(ev.keyCode == 13)
            btnRecoverPass.click();
    });

    btnRecoverPass.on("click", () => {
        if(inpUsername.val().trim() === "")
            Swal.fire("Porfavor digite el usuario!");
        else
        {
            loading.show();

            $.ajax({
                url: `http://${serverHost}/damask/back/validations/recover_password.php`,
                method: "POST",
                data: formRecoverPassword.serialize()
            })
            .done(d => {
                Swal.fire(
                    'Correo Enviado!',
                    d.msg,
                    'success'
                );
            })
            .fail(e => {
                console.log(e);

                Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: e.message
                });
            })
            .always(() => {
                loading.hide();
            });
        }
    });

});