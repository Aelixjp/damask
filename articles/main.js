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

    const menu = new MenuComponent();
    const scrapper = new Scrapper();

    function generateHTMLCards(cards)
    {
        let html = "";

        cards.forEach(({ url, imgURL, title, price }) => {
            const formatter = new Intl.NumberFormat('es-CO');
            const f_price = formatter.format(price);

            html += `<div class="col">
                <div class="card">
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
                                <button type = "button" class = "btn btn-primary mt-3">
                                    $ ${f_price}
                                </button>
                            </div>

                            <!-- Botones adicionales de funciones para cada tarjeta  -->
                            <div class="cardBtnsSection">
                                <button class = "btn btn-warning" type = "button">
                                    <i class="bi bi-star text-white"></i>
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

            console.log(result);

            const html = generateHTMLCards(data);

            contCards.html(html);
        }
    }

    function addListeners()
    {
        profileAvatar.on("click", menu.toggle);
        menu.navItems.on("click", menu.close);
        inpBtnFiltrar.on("click", filterProducts);
    }

    function init()
    {
        addListeners();
    }

    init();

});