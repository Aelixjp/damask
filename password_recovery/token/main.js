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
            alert("Porfavor rellene todos los campos!");
        else if(password != passwordConf)
            alert("Las contraseñas no coinciden!");
        else if(!checkPasswords(password, passwordConf))
            alert(
                "La contraseña debe contener minimo un caracter especial, 1 letra mayuscula y minuscula y un numero, " + 
                "debe ser de minimo 8 caracteres en longitud y maximo 20" 
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
                alert(d.msg);

                if(d.status)
                    location.href = "/damask/";
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});