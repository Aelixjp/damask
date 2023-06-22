import { checkPasswords } from "../globals/utils/utils.js";

$(document).ready (() => {

    const inputUsuario  = $("#inpUsername");
    const inputPassword = $("#inpPassword");
    const inputPasswordConf = $("#inpPasswordConf");

    const endpoint = "http://localhost/damask/back/register/register.php";

    $("#btnLogin").click(() => {

        const usuario = inputUsuario.val() || "";
        const password = inputPassword.val() || "";
        const passwordConf = inputPasswordConf.val() || "";

        const body = new FormData();

        //Comprobamos que el usuario haya enviado información
        if(usuario.trim() === "" || password.trim() === "" || passwordConf.trim() === "")
            alert("Hay campos vacios porfavor verifique!");
        else if(password != passwordConf)
            alert("Las contraseñas no coinciden!");
        else if(!checkPasswords(password, passwordConf))
            alert(
                "La contraseña debe contener minimo un caracter especial, 1 letra mayuscula y minuscula y un numero, " + 
                "debe ser de minimo 8 caracteres en longitud y maximo 20" 
            );
        else
        {
            $.ajax(endpoint, {
                body,
                method: "POST",
                contentType: false,
                processData: false
            })
            .done(d => {
                console.log(d);
            })
            .catch(e => {
                console.log(e.message);
            });
        }

    });

});