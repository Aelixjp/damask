export default class ModalCompareDetails
{
    #data;
    #colors;
    #stadistics;
    #lowerPrice;
    #higherPrice;
    #charStadistic;

    constructor()
    {
        this.#data = [];
        this.#colors = ["bg-primary", "bg-danger", "bg-warning"];
        this.#stadistics = $("#stadistics");
        this.#lowerPrice  = $("#lowerPrice");
        this.#higherPrice = $("#higherPrice");
        this.#charStadistic = $("#chartStadistic");
    }

    updateData = data => 
    {
        this.#data = data;

        this.renderLower();
        this.renderHigher();
        this.renderStatistics();
    }

    getHTML = ({ url, title, price, page_id, ecommerce, image_url }) =>
    {
        const color = this.#colors[page_id - 1];
        const length = this.#data.length;
        const formatter = new Intl.NumberFormat('es-CO');

        return `<div id-card-det="${length}" class="col-sm-3 mb-3 mx-auto">
            <div class="card mt-5">
                <div class = "cardHead ${color}">
                    <p page-id = "${page_id}" class = "cardHeadTitle">${ecommerce}</p>
                </div>

                <a href = "${url}" target = "blank">
                    <img src="${image_url}" class="card-img-top" alt="...">
                </a>

                <div class="card-body">
                    <h5 class="card-title card-title-min">${title}</h5>

                    <hr>

                    <button type = "button" class = "btn btn-primary">
                        $ ${formatter.format(price)}
                    </button>
                </div>
            </div>
        </div>`;
    }

    renderLower = () =>
    {
        const prices = this.#data.map(d => d.price);
        const index  = prices.indexOf(Math.min(...prices));

        this.#lowerPrice.html(this.getHTML(this.#data[index]));
    }

    renderHigher = () =>
    {
        const prices = this.#data.map(d => d.price);
        const index  = prices.indexOf(Math.max(...prices));

        this.#higherPrice.html(this.getHTML(this.#data[index]));
    }

    renderStatistics = () => 
    {
        this.#stadistics.html(`<canvas id = "chartStadistic" class = "mt-5"></canvas>`);
        this.#charStadistic = $("#chartStadistic");

        const texts = this.#data.map(d => d.title.slice(0, 13));
        const pricesSorted = this.#data.map(d => d.price).sort();

        new Chart(this.#charStadistic, {
            type: 'bar',
            data: {
              labels: [...texts],
              datasets: [{
                label: 'Precio',
                data: [...pricesSorted],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
        });
    }

}