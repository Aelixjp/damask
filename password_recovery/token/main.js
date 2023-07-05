import { serverHost, checkPasswords } from "../../globals/utils/utils.js";

$(document).ready(() => {
    const btnRecover      = $("#btnRecoverPass"     );
    const inpPassword     = $("#inpPassword"        );
    const inpPasswordConf = $("#inpPasswordConf"    );
    const formRecoverPass = $("#formRecoverPassword");

    $(window).on("keyup", ev => {
        if(ev.keyCode == 13)
            btnRecover.click();
    });

    btnRecover.on("click", () => {
        const password = inpPassword.val().trim();
        const passwordConf = inpPasswordConf.val().trim();

        if(password === "" || passwordConf === "")
            Swal.fire("Porfavor rellene todos los campos!", '', 'info')
        else if(password != passwordConf)
            Swal.fire("Las contraseñas no coinciden!", '', 'info')
        else if(!checkPasswords(password, passwordConf))
            Swal.fire(
                "Formato Incorrecto Contraseña", 
                "La contraseña debe contener minimo un caracter especial, 1 letra mayuscula, 1 minuscula y un numero, " + 
                "debe ser de minimo 8 caracteres en longitud y maximo 20", 
                'info'
            );
        else
        {
            const urlParams = new URLSearchParams(document.location.search);
            const token = urlParams.get("token");

            $.ajax({
                url: `http://${serverHost}/damask/back/validations/recover_password.php`,
                type: "PUT",
                data: formRecoverPass.serialize() + `&token=${encodeURIComponent(token)}`
            })
            .done(d => {
                if(!d.status)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: d.msg
                    });
                }
                else
                {
                    Swal.fire({
                        title: d.msg,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.href = "/damask/";
                    });
                }
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});