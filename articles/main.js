import MenuComponent from "../components/menu_side/main.js";
import Scrapper from "../classes/Scrapper.js";

$(document).ready(() => {
    const contCards = $("#contCards");
    const profileAvatar = $("#avatarImg");
    const inpProducto = $("#buscarProducto");
    const inpMinPrecio = $("#minPrecio");
    const inpMaxPrecio = $("#maxPrice");
    const inpSearchSize = $("#searchSize");
    const inpEcommerce = $("#commerceType");
    const inpBtnFiltrar = $("#btnFiltrar");
    const usrIdInput = $("#usr_id");

    const menu = new MenuComponent();
    const scrapper = new Scrapper();

    function generateHTMLCards(cards)
    {
        let html = "";

        cards.forEach(({ url, imgURL, title, price, pageID }) => {
            const formatter = new Intl.NumberFormat('es-CO');
            const f_price = formatter.format(price);

            html += `<div class="col">
                <div page-id = "${pageID}" class="card card_listener">
                    <div class = "cardHead bg-primary">
                        <p class = "cardHeadTitle">Mercadolibre</p>
                    </div>

                    <a href = "${url}" target = "blank">
                        <img src="${imgURL}" class="card-img-top" alt="...">
                    </a>

                    <div class="card-body">
                        <h5 class="card-title card-title-min">${title}</h5>
                        
                        <div class="containerCardFooter fixedBottom">
                            <div class="priceSection">
                                <button org-price="${price}" type = "button" class = "btn btn-primary mt-3">
                                    $ ${f_price}
                                </button>
                            </div>

                            <!-- Botones adicionales de funciones para cada tarjeta  -->
                            <div class="cardBtnsSection">
                                <button class = "btn btn-warning save_article" type = "button">
                                    <i class="bi bi-star text-white save_article_icon"></i>
                                </button>

                                <button class = "btn btn-danger" type = "button">
                                    <i class="bi bi-arrow-left-right text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            `;
        });

        return html;
    }

    function toggleSaveButton(ev)
    {
        let icon;

        if($(ev.target).hasClass("save_article_icon"))
            icon = $(ev.target);
        else if($(ev.target).hasClass("save_article"))
            icon = $($(ev.target).children()[0]);

        if(icon.hasClass("bi-star"))
        {
            icon.removeClass("bi-star");
            icon.addClass("bi-star-fill");
        }
        else
        {
            icon.removeClass("bi-star-fill");
            icon.addClass("bi-star");
        }
    }

    function saveProduct(ev)
    {
        const el = $(ev.target);
        let cardContainer;

        if(el.hasClass("save_article"))
            cardContainer = el.parent().parent().parent().parent();
        else if(el.hasClass("save_article_icon"))
            cardContainer = el.parent().parent().parent().parent().parent();
        
        if(cardContainer)
        {
            const endpoint = "http://localhost/damask/back/products/products.php";

            const pageLink = $(cardContainer.find("a")[0]);
            const articleTitle = $(cardContainer.find("div.card-body > h5")[0]);
            const tagPrice = $(cardContainer.find("div.priceSection > button")[0]);

            const userID = usrIdInput.val() | 0;
            const pageID = cardContainer.attr("page-id") | 0;
            const pageURL = pageLink.attr("href");
            const imageURL = $(pageLink.children()[0]).attr("src");
            const articleName = articleTitle.text();
            const articlePrice = parseInt(tagPrice.attr("org-price"));
            const resProducto = "";

            const body = new FormData();

            body.append("action", "save-product");
            body.append("ID_usuario", userID);
            body.append("ID_pagina", pageID);
            body.append("url", pageURL);
            body.append("nombre_producto", articleName);
            body.append("imagen_producto", imageURL);
            body.append("precio_producto", articlePrice);
            body.append("resena_producto", resProducto);

            $.ajax({
                url: endpoint,
                method: "POST",
                data: body,
                contentType: false,
                processData: false
            })
            .done(d => {
                if(d.status)
                {
                    toggleSaveButton(ev);
                    alert("Guardado con exito!");
                }
            })
            .fail(e => {
                console.log(e.message);
            });
        
        }

    }

    async function filterProducts()
    {
        const ecommerce  = inpEcommerce.val();
        const producto   = inpProducto.val();
        const minPrice   = inpMinPrecio.val() | 0;
        const maxPrice   = inpMaxPrecio.val() | 0;
        const searchSize = inpSearchSize.val();

        if(ecommerce == 0)
        {
            alert("Seleccione primero un e-commerce!");
        }
        else
        {
            const params = ["search-product", ecommerce, producto, minPrice, maxPrice, searchSize];
            const result = await scrapper.buscarProductoConFiltros(...params);
            const data = result.data;

            const html = generateHTMLCards(data);

            contCards.html(html);
        }
    }

    function addListeners()
    {
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
        inpBtnFiltrar.on("click", filterProducts);
        contCards.on("click", saveProduct);
    }

    function init()
    {
        addListeners();
    }

    init();

});