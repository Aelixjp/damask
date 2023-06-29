import { serverHost } from "../globals/utils/utils.js";

$(document).ready(() => {
    const inpUsername = $("#inpUsername");
    const btnRecoverPass = $("#btnRecoverPass"   );
    const formRecoverPassword = $("#formRecoverPassword");

    $(window).on("keyup", ev => {
        if(ev.keyCode == 13)
            btnRecoverPass.click();
    });

    btnRecoverPass.on("click", () => {
        if(inpUsername.val().trim() === "")
            alert("Porfavor digite el usuario!");
        else
        {
            $.ajax({
                url: `http://${serverHost}/damask/back/validations/recover_password.php`,
                method: "POST",
                data: formRecoverPassword.serialize()
            })
            .done(d => {
                alert(d.msg);
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});