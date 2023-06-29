import { serverHost, checkPasswords } from "../../globals/utils/utils.js";

$(document).ready(() => {
    const btnRecover      = $("#btnRecoverPass" );
    const inpPassword     = $("#inpPassword"    );
    const inpPasswordConf = $("#inpPasswordConf");

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
            const data = new FormData();

            data.append("password", password);
            data.append("passwordConf", passwordConf);

            $.ajax({
                url: `http://${serverHost}/damask/back/validations/login.php`,
                method: "PUT",
                data,
                contentType: false,
                processData: false
            })
            .done(d => {
                if(!d.status)
                    alert(d.msg);
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});