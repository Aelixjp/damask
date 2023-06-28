import { serverHost } from "./globals/utils/utils.js";

$(document).ready(() => {
    const formLogin   = $("#formLogin"  );
    const btnLogin    = $("#btnLogin"   );
    const inpUsername = $("#inpUsername");
    const inpPassword = $("#inpPassword");

    $(window).on("keyup", ev => {
        if(ev.keyCode == 13)
            btnLogin.click();
    });

    btnLogin.on("click", () => {
        if(inpUsername.val().trim() === "" || inpPassword.val().trim() === "")
            alert("Porfavor rellene todos los campos!");
        else
        {
            $.ajax({
                url: `http://${serverHost}/damask/back/validations/login.php`,
                method: "POST",
                data: formLogin.serialize()
            })
            .done(d => {
                if(!d.status)
                    alert(d.msg);
                else
                    location.href = "/damask/articles/";
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});