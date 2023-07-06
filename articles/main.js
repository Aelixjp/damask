import ModalCompare from "../components/modals/comparar_productos/index.js";
import MenuComponent from "../components/menu_side/main.js";
import LoadingComponent from "../components/loader/main.js";
import Scrapper from "../classes/Scrapper.js";
import { convertCurrency, serverHost } from "../globals/utils/utils.js";

$(document).ready(() => {
    const options          = $("#containerHeaderBtns");
    const page_items       = $(".page-item"          );
    const contCards        = $("#contCards"          );
    const usrIdInput       = $("#usr_id"             );
    const inpProducto      = $("#buscarProducto"     );
    const inpMinPrecio     = $("#minPrecio"          );
    const inpMaxPrecio     = $("#maxPrice"           );
    const inpEcommerce     = $("#commerceType"       );
    const inpSearchSize    = $("#searchSize"         );
    const profileAvatar    = $("#avatarImg"          );
    const inpBtnFiltrar    = $("#btnFiltrar"         );
    const noDisplayContent = $("#noDisplayContent"   );
    const inpPag           = $("#inpPagination"      );

    const menu = new MenuComponent();
    const loading = new LoadingComponent();
    const modalCompare = new ModalCompare();
    const scrapper = new Scrapper();

    function generateHTMLCards(cards)
    {
        let html = "";

        cards.forEach(({ url, imgURL, title, price, pageID }) => {
            const ecommerce  = pageID > 0 ? $(inpEcommerce.children()[pageID]).text() : "";
            const formatter  = new Intl.NumberFormat('es-CO');
            const f_price    = formatter.format(price);
            const cardColor  = pageID == 1 ? "bg-primary" : pageID == 2 ? "bg-danger" : "bg-warning";

            html += `<div class="col">
                <div page-id = "${pageID}" class="card card_listener">
                    <div class = "cardHead ${cardColor}">
                        <p class = "cardHeadTitle">${ecommerce}</p>
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
                                <!-- Boton Guardar Articulo -->
                                <button class = "btn btn-warning save_article" type = "button">
                                    <i class="bi bi-star text-white save_article_icon"></i>
                                </button>

                                <!-- Boton Añadir a la lista de Comparar Articulo -->
                                <button 
                                    attr-url = '${url}'
                                    attr-title = '${title}'
                                    attr-price = '${price}'
                                    attr-page-id = '${pageID}'
                                    attr-ecommerce = '${ecommerce}'
                                    attr-image-url = '${imgURL}'
                                    class = "btn btn-danger btnCompareArt" type = "button">
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

    function showOptions()
    {
        options.removeClass("d-none");
    }

    function hideNoDisplayContainer()
    {
        noDisplayContent.addClass("d-none");
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
            const endpoint = `http://${serverHost}/damask/back/products/products.php`;

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
                    const productID = d.data.ID;

                    cardContainer.attr("id", `product_${productID}`);

                    toggleSaveButton(ev);

                    Swal.fire(
                        'Guardado!',
                        'Tu articulo se ha guardado correctamente.',
                        'success'
                    );
                }
            })
            .fail(e => {
                console.log(e.message);
            });
        
        }

    }

    function deleteArticle(ev)
    {
        const target = $(ev.target);
        let container;

        if(target.hasClass("save_article"))
            container = target.parent().parent().parent().parent();
        else if(target.hasClass("bi-star") || target.hasClass("bi-star-fill"))
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

                            toggleSaveButton(ev);
                        }
                    })
                    .catch(e => {
                        console.log(e.message);
                    });
                }
            });
        }
    }

    function saveOrDeleteProduct(ev)
    {
        let btn;
        const target = $(ev.target);

        if(target.hasClass("save_article"))
            btn = $(target.children()[0]);
        else if(target.hasClass("bi-star") || target.hasClass("bi-star-fill"))
            btn = target;

        if(btn)
        {
            if(btn.hasClass("bi-star"))
                saveProduct(ev);
            else if(btn.hasClass("bi-star-fill"))
                deleteArticle(ev);
        }
    }

    async function filterProducts()
    {
        const ecommerceIndex = inpEcommerce[0].selectedIndex;
        
        const pageID        = inpEcommerce.val();
        const instanceID    = usrIdInput.val();
        const ecommerce     = pageID > 0 ? $(inpEcommerce.children()[ecommerceIndex]).text() : "";
        const producto      = inpProducto.val();
        const minPrice      = inpMinPrecio.val() | 0;
        const maxPrice      = inpMaxPrecio.val() | 0;
        const searchSize    = inpSearchSize.val();
        const pagNavigation = inpPag.val();

        if(pageID == 0)
            Swal.fire("Seleccione primero un e-commerce!");
        else if(!instanceID || instanceID == 0)
            Swal.fire("Su sesion ha expirado, porfavor vuelva a iniciar sesion!");
        else
        {
            let dollarInCop = 0; loading.show();

            const params = ["search-product", pageID, instanceID, ecommerce, producto, minPrice, maxPrice, pagNavigation, searchSize];
            const result = await scrapper.buscarProductoConFiltros(...params);
            let data = result.data;

            //Hay que convertir primero los precios de USD a COP
            if(ecommerce == "Amazon")
            {
                const currency = await convertCurrency(1); dollarInCop = currency.new_amount;

                data = data.map(dt => {
                    dt.price = Math.round(parseFloat(dt.price) * dollarInCop);

                    return dt;
                });
            }

            const html = generateHTMLCards(data);

            contCards.html(html);
            
            showOptions();
            addCompareEvent();
            hideNoDisplayContainer();
        }

        loading.hide();
    }

    function addToCompareList(ev)
    {
        const btn = $(ev.currentTarget);
        
        const url = btn.attr("attr-url");
        const title = btn.attr("attr-title");
        const price = parseFloat(btn.attr("attr-price"));
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

    function addCompareEvent()
    {
        $(".btnCompareArt").on("click", addToCompareList);
    }

    function handleFilterByKeyEvent(ev)
    {
        if(ev.keyCode == 0xD) inpBtnFiltrar.click();
    }

    function setActivePage(ev)
    {
        const page = $(ev.currentTarget);
        const isBackPage = page.hasClass("backPage");
        const isNextPage  = page.hasClass("nextPage");

        const currPageActive = $($(".page-item.active")[0]);

        const isFirstPage = currPageActive.hasClass("firstPage");
        const isLastPage  = currPageActive.hasClass("lastPage");

        if(isBackPage)
        {
            if(!isFirstPage)
            {
                const previous = currPageActive[0].previousElementSibling; previous.click();
            }
        }
        else if(isNextPage)
        {
            if(!isLastPage)
            {
                const next = currPageActive[0].nextElementSibling; next.click();
            }
        }
        else
        {
            currPageActive.removeClass("active");
            page.addClass("active");

            inpPag.val(page.children()[0].textContent | 0);
            filterProducts();
        }
    }

    function addListeners()
    {
        $(window).on("keyup", handleFilterByKeyEvent);
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
        inpBtnFiltrar.on("click", filterProducts);
        contCards.on("click", saveOrDeleteProduct);
        page_items.on("click", setActivePage)
    }

    function init()
    {
        addListeners();
    }

    init();

});