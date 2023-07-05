export default class ModalCompare
{
    #data;
    #modal;
    #colors;
    #emptyProd
    #cardsCont;
    #compareProdSection;

    constructor()
    {
        this.#data = [];
        this.#modal = $("#modalCompProducto");
        this.#emptyProd = $("#emptyProducts");
        this.#cardsCont = $("#contentProductsComp");
        this.#compareProdSection = $("#compareProdSection");
        this.#colors = ["bg-primary", "bg-danger", "bg-warning"];
    }

    pushData = data =>
    {
        this.#data.push(data);
        this.updateViewByPush(data);
    }

    updateViewByPush = ({ url, title, price, page_id, ecommerce, image_url }) => 
    {
        const color = this.#colors[page_id - 1];
        const formatter  = new Intl.NumberFormat('es-CO');

        const newHtml = `<div class="col-sm-3 mb-3">
            <div class="card">
                <div class = "cardHead ${color}">
                    <p page-id = "${page_id}" class = "cardHeadTitle">${ecommerce}</p>
                </div>

                <a href = "${url}" target = "blank">
                    <img src="${image_url}" class="card-img-top" alt="...">
                </a>

                <div class="card-body">
                    <h5 class="card-title card-title-min">${title}</h5>

                    <hr>

                    <button type = "button" class = "btn btn-primary btn-abs">
                        $ ${formatter.format(price)}
                    </button>
                </div>
            </div>
        </div>`;
        
        this.#emptyProd.addClass("d-none");
        this.#compareProdSection.removeClass("d-none");
        this.#cardsCont[0].innerHTML += newHtml;
    }

}