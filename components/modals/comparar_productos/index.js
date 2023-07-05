import ModalCompareDetails from "../comparar_productos_detalle/index.js";

export default class ModalCompare
{
    #data;
    #colors;
    #emptyProd
    #cardsCont;
    #btnCompareProd;
    #btnModCompClose;
    #compareProdSection;
    #modalCompareDetails;

    constructor()
    {
        this.#data = [];
        this.#emptyProd = $("#emptyProducts");
        this.#cardsCont = $("#contentProductsComp");
        this.#btnCompareProd = $("#btnCompareProd");
        this.#btnModCompClose = $("#btnModCompClose");
        this.#compareProdSection = $("#compareProdSection");
        this.#colors = ["bg-primary", "bg-danger", "bg-warning"];
        this.#modalCompareDetails = new ModalCompareDetails();

        this.addEvents();
    }

    addEvents = () => 
    {
        this.#btnCompareProd.on("click", this.showModalCompareDetailed);
    }

    pushData = data =>
    {
        this.#data.push(data);
        this.updateViewByPush(data);
    }

    showModalCompareDetailed = () => 
    {
        this.#modalCompareDetails.updateData(this.#data);
        this.#btnModCompClose.click();
    }

    deleteFromCompareList = ev => 
    {
        const target = $(ev.currentTarget);

        Swal.fire({
            title: 'Estas seguro que deseas eliminar este articulo de la lista?',
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar!',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if(result.isConfirmed)
            {
                const allEl = $(`div[id-card]`);
                const mtarget = allEl.map((i, el) => {
                    return target.attr("id-card") == $(el).attr("id-card");
                }).get();

                const idTarget = mtarget.indexOf(true); target.remove();
                this.#data.splice(idTarget, 1);

                if(this.#data.length == 0)
                {
                    this.#emptyProd.removeClass("d-none");
                    this.#compareProdSection.addClass("d-none");
                }
            }
        });
    }

    updateViewByPush = ({ url, title, price, page_id, ecommerce, image_url }) => 
    {
        const color = this.#colors[page_id - 1];
        const length = this.#data.length;
        const formatter = new Intl.NumberFormat('es-CO');

        const newHtml = `<div id-card="${length}" class="col-sm-3 mb-3">
            <div class="card">
                <div class = "cardHead ${color}">
                    <p page-id = "${page_id}" class = "cardHeadTitle">${ecommerce}</p>
                    <button class = 'btn btn-link removeCardBtn'>
                        <i class="bi bi-x-lg"></i>
                    </button>
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

        $(`div[id-card]`).on("click", this.deleteFromCompareList);
    }

}