import MenuComponent from "../components/menu_side/main.js";
import ModalCompare from "../components/modals/comparar_productos/index.js";
import { serverHost } from "../globals/utils/utils.js";

$(document).ready()
{
    const inpSearch = $("#inpSearch");
    const searchBtn = $("#searchBtn");
    const artFilters = $("#artFilters");
    const profileAvatar = $("#avatarImg");
    const btnMyArticles = $(".btn-my-articles");
    const selectEcommerce = $("#commerceType");
    const noEcommerceFilter = $("#noEcommerceFilter");
    const noContentContainer = $("#noContentContainer");
    const containerMyArticles = $("#containerMyArticles");
 
    const menu = new MenuComponent();
    const modalCompare = new ModalCompare();

    function showNoArticlesFilterEcommerce()
    {
        noEcommerceFilter.show();
        noEcommerceFilter.removeClass("d-none");
    }

    function hideNoArticlesFilterEcommerce()
    {
        noEcommerceFilter.hide();
        noEcommerceFilter.addClass("d-none");
    }

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
            Swal.fire({
                title: 'Estas seguro que deseas eliminar el articulo de favoritos?',
                text: "Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar!',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
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

                            const col = $(container).parent(); col.remove();

                            if(containerMyArticles.children().length <= 3)
                            {
                                artFilters.addClass("d-none");
                                noContentContainer.removeClass("d-none");
                            }
                        }
                    })
                    .catch(e => {
                        console.log(e.message);
                    });
                }
            });
        }
    }

    function changeEcommerce(ev)
    {
        let cards = $(".col-sm-3");
        const val = $(ev.target).val() | 0;

        //Mostrar todo
        if(val === 0)
        {
            cards.removeClass("d-none");
            hideNoArticlesFilterEcommerce();
        }
        //Mostrar lo seleccionado
        else
        {
            cards.addClass("d-none");

            cards = cards.filter((i, card) => {
                return $(card).has(`p[page-id="${val}"]`).length != 0;
            });

            if(cards.length === 0)
                showNoArticlesFilterEcommerce();
            else
                hideNoArticlesFilterEcommerce();

            cards.removeClass("d-none");
        }
    }

    function searchContent()
    {
        const searchContent = inpSearch.val();
        const cardsDefiner = ".col-sm-3";
        
        let cards = $(cardsDefiner);

        let results = cards.filter((i, card) => {
            const cardText = $(card).find(".card-title-min").text();

            return cardText.toLowerCase().includes(searchContent.toLowerCase());
        });

        if(results.length === 0)
            showNoArticlesFilterEcommerce();
        else
            hideNoArticlesFilterEcommerce();

        cards.addClass("d-none");
        results.removeClass("d-none");
    }

    function addToCompareList(ev)
    {
        const btn = $(ev.currentTarget);
        
        const url = btn.attr("attr-url");
        const title = btn.attr("attr-title");
        const price = btn.attr("attr-price");
        const page_id = btn.attr("attr-page-id") | 0;
        const ecommerce = btn.attr("attr-ecommerce");
        const image_url = btn.attr("attr-image-url");

        const data = { url, title, price, page_id, ecommerce, image_url };

        Swal.fire(
            'Añadido a la lista!',
            'Tu articulo se ha añadido a la lista de comparación!',
            'success'
        );

        modalCompare.pushData(data);
    }

    function addListeners()
    {
        searchBtn.on("click", searchContent);
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
        btnMyArticles.on("click", deleteArticle);
        selectEcommerce.on("change", changeEcommerce);

        $(".btnCompareArt").on("click", addToCompareList);

        $(window).on("keyup", ev => ev.keyCode === 0xD ? searchContent(ev) : null);
    }

    function init()
    {
        addListeners();
    }

    init();
    
}