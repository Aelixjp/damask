import { serverHost } from "../globals/utils/utils.js";

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

export default class Scrapper
{

    constructor()
    {
        this.endpoint = `http://${serverHost}:8081/damask/api`;
    }

    buscarProductoConFiltros = (action, ecommerce, name, minPrice, maxPrice, searchSize = 20) =>
    {
        const body = new FormData();

        /*body.append("action"    , "search-product");
        body.append("pageID"    , 3               );
        body.append("name"      , "Portatil"      );
        body.append("minPrice"  , 100000          );
        body.append("maxPrice"  , 4000000         );
        body.append("searchSize", 20              );*/

        body.append("action"    , action    );
        body.append("pageID"    , ecommerce );
        body.append("name"      , name      );
        body.append("minPrice"  , minPrice  );
        body.append("maxPrice"  , maxPrice  );
        body.append("searchSize", searchSize);

        return $.ajax(
            {
                url: encodeURI(`${this.endpoint}${body.toURL()}`),
                method: "GET"
            }
        );
    }

}