import { checkEmail, checkPasswords, serverHost } from "../globals/utils/utils.js";

$(document).ready (() => {

    const btnRegister = $("#btnLogin");
    const inputName = $("#inpName");
    const inputEmail = $("#inpCorreo");
    const inputUsuario  = $("#inpUsername");
    const inputPassword = $("#inpPassword");
    const inputPasswordConf = $("#inpPasswordConf");

    const endpoint = `http://${serverHost}/damask/back/register/register.php`;

    $(window).on("keyup", ev => {
        if(ev.keyCode == 13)
            btnRegister.click();
    });

    btnRegister.click(() => {

        const name = inputName.val() || "";
        const email = inputEmail.val() || "";
        const username = inputUsuario.val() || "";
        const password = inputPassword.val() || "";
        const passwordConf = inputPasswordConf.val() || "";

        //Comprobamos que el usuario haya enviado información
        if(
            name.trim()         === "" ||
            email.trim()        === "" ||
            username.trim()     === "" || 
            password.trim()     === "" || 
            passwordConf.trim() === ""
        )
            Swal.fire("Hay campos vacios porfavor verifique!");
        else if(!checkEmail(email))
            Swal.fire("El correo electronico no es valido!");
        else if(password != passwordConf)
            Swal.fire("Las contraseñas no coinciden!");
        else if(!checkPasswords(password, passwordConf))
        {
            Swal.fire(
                "Formato Incorrecto Contraseña",
                "La contraseña debe contener minimo un caracter especial, 1 letra mayuscula, 1 minuscula y un numero, " + 
                "debe ser de minimo 8 caracteres en longitud y maximo 20",
                "question"
            );
        }
        else
        {
            const body = new FormData();

            body.append("name", name);
            body.append("email", email);
            body.append("username", username);
            body.append("password", password);
            body.append("passwordConf", passwordConf);

            $.ajax(endpoint, {
                data: body,
                method: "POST",
                contentType: false,
                processData: false
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
                    location.href = "/damask/articles/";
            })
            .catch(e => {
                console.log(e);
                console.log(e.message);
            });
        }

    });

});