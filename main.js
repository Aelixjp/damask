FormData.prototype.toURL = function()
{
    let buildURL = ""; let i = 0;

    for(const entry of this.entries())
    {
        buildURL += i != 0 ? "&" : "?";
        buildURL += `${entry[0]}=${entry[1]}`;

        i++;
    }

    return buildURL;
}

$(document).ready(() =>{
    const formLogin   = $("#formLogin"  );
    const btnLogin    = $("#btnLogin"   );
    const inpUsername = $("#inpUsername");
    const inpPassword = $("#inpPassword");

    const endpoint = "http://localhost:8081/damask/api";

    const body = new FormData;

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
                url: "http://localhost/damask/back/validations/login.php",
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

    body.append("action"    , "search-product");
    body.append("pageID"    , 3               );
    body.append("name"      , "Portatil"      );
    body.append("minPrice"  , 100000          );
    body.append("maxPrice"  , 4000000         );
    body.append("searchSize", 30              );

    $.ajax(
        {
            url: encodeURI(`${endpoint}${body.toURL()}`),
            method: "GET"
        }
    )
    .done(dt => {
        console.log(dt);
    })
    .fail(e => console.error(e.responseText));

});