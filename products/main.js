import MenuComponent from "../components/menu_side/main.js";
import { serverHost } from "../globals/utils/utils.js";

$(document).ready()
{
    const profileAvatar = $("#avatarImg");
    const btnMyArticles = $(".btn-my-articles");
 
    const menu = new MenuComponent();

    function deleteArticle(ev)
    {
        const target = $(ev.target);
        let container;

        if(target.hasClass("btn-my-articles"))
            container = target.parent().parent().parent().parent();
        else if(target.hasClass("bi-star-fill"))
            container = target.parent().parent().parent().parent().parent();

        if(container)
        {
            const id = container.attr("id").split("_")[1] | 0;

            $.ajax({
                url: `http://${serverHost}/damask/back/products/products.php`,
                type: "DELETE",
                data: `id=${encodeURIComponent(id)}`
            })
            .then(d => {
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
                    Swal.fire(
                        'Eliminado!',
                        d.msg,
                        'success'
                    );

                    const col = $(container).parent();
    
                    col.remove();
                }
            })
            .catch(e => {
                console.log(e.message);
            });
        }
    }

    function addListeners()
    {
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
        btnMyArticles.on("click", deleteArticle);
    }

    function init()
    {
        addListeners();
    }

    init();
    
}