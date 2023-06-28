$(document).ready(() => {
    const formRecoverPassword = $("#formRecoverPassword");
    const btnRecoverPass    = $("#btnRecoverPass"   );
    const inpUsername = $("#inpUsername");

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
                url: "http://localhost/damask/back/validations/recover_password.php",
                method: "POST",
                data: formRecoverPassword.serialize()
            })
            .done(d => {
                if(!d.status)
                    alert(d.msg);
                else
                    location.href = "/damask/";
            })
            .fail(e => {
                console.log(e);
            });
        }
    });

});