<?php

    require_once "../globals/globals.php";
    require_once "../back/validations/security.php";
    require_once "../back/validations/check_authenticated.php";

    setlocale(LC_MONETARY, 'es_CO');

    $resData =
        json_decode('[
            {
                "id": 0,
                "url": "https://click1.mercadolibre.com.co/mclics/clicks/external/MCO/count?a=BoXrL2CZdNtjnuORPRjOuffWc2NH72h0OHuA44FaXhxjNn2GpgejxjgtEY07%2FtjZxLqZQK8yu0BbSzmPvPYBCGLQMaGikM5iamfF4oqW1Yyse83PFoSuBJcZ4PqG0thdn6n8OMvOUs66jPjbqToG9Dp%2BI1oaakUXApJUB0z%2F3vYzpkaxp2Me8Yaz5a1RkqJrVfDS2xE%2Bu0i7QMJxMWsrh2H4ChyC4EW08rIzWstkjvsG7zX1WA2mn4xEMV5zPls8O1Ru7St0I5orZeevmmOBtuHoLlYEzLwadloRqAp6X0B6dUMbPJg%2BtHImLgc6MjgZ2BY5k0hKOPciOHWMaVP4cX2hhIqrehFEYJc9m3Gm5uqh%2F%2Fq5giLdPupcbEgNm2tqEOgeTN7ozd%2FD2Shn0DDdFcS9QiaCmmTavYqwdy1fqcLMgB5rnwEBH8uF%2F34So8dc2VrwwAHnPYwjLGQGZ4OyvvViIoUIH6aKWczEQFXII5VbXudGkQUCJTgCQYoQ38qeRaWlOGzWCSOGr4EmgLHMUcomGFuCg6HfyT0lymy70CkeGACcqCOv2%2BFbajCpQOhn14yLoB5o7htgqt1jxvkif9zalPXCtazonVgVOz2Ar9v8NBwa%2B%2FKJXZ8uroPdPn%2FacW0Xi5Jwcy9%2FyX3WteVOhuQFUl3qLH2ihG7O7X0K467d7ACLUsicd4oOToRTeLMvNQZ6fIfGm8c%2Bd%2FYtN%2Bd7eLxLGymQJJ21bnRIg9tA9T8pV0r%2F%2FIRqMxnRyL3QiVKhNurjmjZP6L5af7SuTIDbsIRRZ7zBhEfM%2Bb%2BoCQuP4T1nb6dNpCuqPxMdaKwl6j7oiJASWAvcsbyjUYk%2FmXC0osiikA%3D%3D&rb=x",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_714273-MLA47751707036_102021-V.webp",
                "title": "Laptop Lenovo IdeaPad 14IGL05  platinum gray 14\", Intel Celeron N4020  4GB de RAM 1TB HDD, Intel HD Graphics 600 1366x768px Windows 10 Home",
                "price": 899000
              },
              {
                "id": 1,
                "url": "https://www.mercadolibre.com.co/laptop-hp-255-g7-gris-156-amd-athlon-3020e-8gb-de-ram-1tb-hdd-amd-radeon-rx-vega-3-1366x768px-freedos/p/MCO18638127?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO18638127&position=2&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_984848-MLA48644126914_122021-V.webp",
                "title": "Laptop HP 255 G7 gris 15.6\", AMD Athlon 3020E  8GB de RAM 1TB HDD, AMD Radeon RX Vega 3 1366x768px FreeDOS",
                "price": 871653
              },
              {
                "id": 2,
                "url": "https://www.mercadolibre.com.co/laptop-dell-inspiron-3505-gris-156-amd-ryzen-5-3450u-16gb-de-ram-1tb-hdd-256gb-ssd-amd-radeon-rx-vega-8-60-hz-1366x768px-windows-10-home/p/MCO16999023?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO16999023&position=3&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_921052-MLA47215256520_082021-V.webp",
                "title": "Laptop Dell Inspiron 3505 gris 15.6\", AMD Ryzen 5 3450U  16GB de RAM 1TB HDD 256GB SSD, AMD Radeon RX Vega 8 60 Hz 1366x768px Windows 10 Home",
                "price": 2254180
              },
              {
                "id": 3,
                "url": "https://www.mercadolibre.com.co/laptop-dell-inspiron-3505-gris-156-amd-ryzen-5-3450u-16gb-de-ram-256gb-ssd-amd-radeon-rx-vega-8-60-hz-1366x768px-windows-10-home/p/MCO16999018?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO16999018&position=4&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_904967-MLA47215230827_082021-V.webp",
                "title": "Laptop Dell Inspiron 3505 gris 15.6\", AMD Ryzen 5 3450U  16GB de RAM 256GB SSD, AMD Radeon RX Vega 8 60 Hz 1366x768px Windows 10 Home",
                "price": 2183540
              },
              {
                "id": 4,
                "url": "https://www.mercadolibre.com.co/laptop-lenovo-ideapad-14igl05-platinum-gray-14-intel-celeron-n4020-4gb-de-ram-1tb-hdd-intel-hd-graphics-600-1366x768px-windows-10-home/p/MCO18510836?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO18510836&position=5&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_714273-MLA47751707036_102021-V.webp",
                "title": "Laptop Lenovo IdeaPad 14IGL05  platinum gray 14\", Intel Celeron N4020  4GB de RAM 1TB HDD, Intel HD Graphics 600 1366x768px Windows 10 Home",
                "price": 899000
              },
              {
                "id": 5,
                "url": "https://www.mercadolibre.com.co/laptop-dell-inspiron-3505-negra-156-amd-ryzen-5-3450u-12gb-de-ram-1tb-hdd-256gb-ssd-amd-radeon-rx-vega-8-60-hz-windows-10-home/p/MCO16999016?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO16999016&position=6&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_912142-MLA49041547588_022022-O.webp",
                "title": "Laptop Dell Inspiron 3505 negra 15.6\", AMD Ryzen 5 3450U  12GB de RAM 1TB HDD 256GB SSD, AMD Radeon RX Vega 8 60 Hz Windows 10 Home",
                "price": 2229374
              },
              {
                "id": 6,
                "url": "https://www.mercadolibre.com.co/laptop-hp-245-g7-negra-14-amd-3020e-8gb-de-ram-1tb-hdd-amd-radeon-rx-vega-3-1366x768px-windows-10-home/p/MCO18619200?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO18619200&position=7&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_600265-MLA48808603714_012022-O.webp",
                "title": "Laptop HP 245 G7 negra 14\", AMD 3020E  8GB de RAM 1TB HDD, AMD Radeon RX Vega 3 1366x768px Windows 10 Home",
                "price": 949900
              },
              {
                "id": 7,
                "url": "https://click1.mercadolibre.com.co/mclics/clicks/external/MCO/count?a=gNilEIW3%2BQQLBo5fnv0lUlCIq3K%2BNd3%2B6waOgImgZP%2F4YExROE%2Fitr6LeOjkdxxEkgV7KJYxF6%2BuSe0CWudPHrUTH1zZHPsFMr5zIWki2JhSQ8ZNXyM6TC3lcwEyMY686%2BCKOrOLtZPOaZ%2B9mvKRm%2FP%2FXKJGA%2FMgzqmRVY7RkUblQyTRFhAFaW6SgDYgkT4bhAe5xX7E8zGEljLmuhSza7NBjHABww1GEhzsfkUKY6DSTFtk9CoEE0u2FfSeWLidHEgwUErBfxRqmdKTqHoiJDsBM89OQGXYyDI2Ki2sP6iBfoBumq8zZ4cwX3feQraXL0sbSQQCnNwkCubNT3sTHDpv%2FfcPdPcjATQNxyL1f4Qqz5NFVr85rFhMaod32MuKKRqcxhjq3HR8BCXv%2BrppJ6SjED09ETAaaEgcT4VDnelE%2B9dP%2BzODfFW1X2duNHVZpqgHqfjeFl92G%2FnqT0ZbzHhFv5oDJG4BykFuLX7b3r%2FasrHiEMr%2FRYnWBCzKH0hALs%2FEjb1c3Q%2FcJTn2QMo4XSn%2BRMPjbbC7Es8efX8FgUP63CBvWB2uEvfuPipxcB5GHKBlIPwHhYzC48lVwCyTPeFB8ZQqKEiTNwra6PM2G%2BqW3RScSZROK3ISjSCNnhCLa%2B5rhbPS3uz0RFRgfO6mETk8rmzz0dMqozKzwdsN54Zo87kRXg3oOYrFGSnCG960KPyBGGWyemZQ%2FqHqan8iZzUh9JyvQxiibjhmKlu7ra6d0sVwYd4bNfN%2FCpWwz2qW64EhR1K6DspueyOwJrDBerNjfg9EoKJkKwCSbm0j&rb=x",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_851018-MCO48498221875_122021-O.webp",
                "title": "Computador Portátil Hp 240 G7 Intel Celeron Ram 8gb Hdd 1 Tb",
                "price": 1214650
              },
              {
                "id": 8,
                "url": "https://click1.mercadolibre.com.co/mclics/clicks/external/MCO/count?a=1x33fKANp%2Fs73VFDjwPUrtUSUKjVB7LfjdmnFXGYCT6fC68uHA1vLsSar%2BT%2BU7YZKWMyDP7M2TS5SVN1Wp%2BvvbJZQM9amtDeWQeHR0qYxgei3mAbF3dAp9oXhxUXfx3TgtNFlkyd3gvd6cXHkbBitIDLfG9TzXExksxBHlBBPuFU3Z56vZ7MtBR2dpgUgOd3VQ5x5HTb02pvJ8vJmMSvYPDdCBd4Fly%2Frma1O3lTZghQQux7IqWb680mohld9VQcmTuI%2F3Dg%2F8XDRFWY4YNZ9RbzRhV6rv1B7nxc%2B5ffjmQrGGQ5eqsPNm4ZIOFZ7NIUbvq8IDYUEvZrh0d9vFTeA67sXIAydh9MYwr4GLnjWBdPX%2FpvcZJMi6xcoa2SV4PIWLck9haeepGewVp3V1W%2FS8d1Y7QnusOWwTTyH17l87KyhmwILMvuRXPRl2ULSIvbZgHDyrWaEr2eahjQJNsM0eeW7L%2B2ehWhvu03s4VaQPCejgnYnS5rfjrIl2EUCzr1RPWQ4ywFgTubTZkcMBgKvhWnRfs0MKaR9odxtmNadruhS7e2mA6W48PxzErcB4W216CbFiKpYblgUyyMWLrKo7T1utZ9Be3%2FXE7XTs5LiB4ulwdkbDLAtW4xrXoNP19Qekffd5y%2BEDId9TXaXRz%2FWE4IA1fYpIwsgstdPBJsO1MqeHc1OcKoDFJE1NBtKU1h1XrD0rkGHcRVsUBoJwXmW7j5M0ugLlpsNyHKj3u2ZeGa5OYg6uFUdmrDDEsKthZnBbGH4fDv%2Bcrs5kj7hNpT%2BKUQid4aPENtPiopXpR%2F&rb=x",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_816589-MCO49741654867_042022-O.webp",
                "title": "Computador Portatil Asus X543m Celeron 1 Tb 4gb 15 Pul Win10",
                "price": 1009000
              },
              {
                "id": 9,
                "url": "https://articulo.mercadolibre.com.co/MCO-598039701-portatil-dell-3505-ryzen-5-3450u-16gb-ssd-2561tb-156-win10-_JM?searchVariation=70428414490#searchVariation=70428414490&position=35&search_layout=stack&type=item&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_983509-MCO49357084849_032022-O.webp",
                "title": "Portátil Dell 3505 Ryzen 5 3450u 16gb Ssd 256+1tb 15.6 Win10",
                "price": 2269900
              },
              {
                "id": 10,
                "url": "https://articulo.mercadolibre.com.co/MCO-656868273-portatil-asus-14-onceava-core-i3-1115g4-12gb-256-gb-ssd-fhd-_JM?searchVariation=94584552331#searchVariation=94584552331&position=36&search_layout=stack&type=item&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_937085-MCO49959929235_052022-O.webp",
                "title": "Portátil Asus 14 Onceava Core I3-1115g4 12gb 256 Gb Ssd Fhd ",
                "price": 1679000
              },
              {
                "id": 11,
                "url": "https://www.mercadolibre.com.co/laptop-dell-inspiron-3505-plata-156-amd-ryzen-5-3450u-8gb-de-ram-256gb-ssd-amd-radeon-rx-vega-8-60-hz-1366x768px-windows-11-home/p/MCO16537306?pdp_filters=category:MCO1652%7Cprice:100000-4000000#searchVariation=MCO16537306&position=10&search_layout=stack&type=product&tracking_id=69e42012-f192-44c4-a0d5-1ad3b7b08dcb",
                "imgURL": "https://http2.mlstatic.com/D_NQ_NP_899144-MLA47215243707_082021-O.webp",
                "title": "Laptop Dell Inspiron 3505 plata 15.6\", AMD Ryzen 5 3450U  8GB de RAM 256GB SSD, AMD Radeon RX Vega 8 60 Hz 1366x768px Windows 11 Home",
                "price": 2109300
              }
          ]');

    

?>

<!DOCTYPE html>
<html lang="es" class = "d-block w-100 h-100">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php require_once "../globals/links/links.php"; ?>

        <link rel="stylesheet" href="<?= APP_LOCAL; ?>/headers/menu.styles.css">
        <link rel="stylesheet" href="<?= LIBRARIES_URL_LOCAL; ?>/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="styles.css">

        <script type="module" src="main.js"></script>

        <title>Articles</title>
    </head>

    <body class = "bg-light position-relative d-block w-100 h-100">
        <?php require_once "../headers/menu.php"; ?>

        <?php require_once "../components/menu_side/menu_side.php"; ?>

        <div class="container-fluid contentBody px-0">
            <div class="row w-100 h-100">
                <aside class="col-md-3 h-100 bg-side p-4">
                    <div class="form-group">
                        <label for="buscarProducto">Buscar Producto</label>
                        <input type="text" class="form-control" id="buscarProducto" aria-describedby="emailHelp" placeholder="Producto...">
                    </div>

                    <div class="form-group">
                        <label for="minPrecio">Precio minimo:</label>
                        <input type="number" class = "form-control" name="minPrecio" id="minPrecio" aria-describedby="minPrecio"
                        min = "0" placeholder = "Minimo...">
                    </div>

                    <div class="form-group">
                        <label for="maxPrice">Precio maximo:</label>
                        <input type="number" class = "form-control" name="maxPrice" id="maxPrice" aria-describedby="maxPrice"
                        min = "0" placeholder = "Maximo...">
                    </div>

                    <div class="form-group">
                        <label for="commerceType">E commerce:</label>
                        <select name="commerceType" id="commerceType" class = "form-select">
                            <option value="0">Seleccione e-commerce...</option>

                            <option value="1">Amazon</option>
                            <option value="2">Aliexpress</option>
                            <option value="3">Mercadolibre</option>
                        </select>
                    </div>

                    <div class="form-group text-center mt-5">
                        <button type = "button" class = "btn btn-primary">Filtrar</button>
                    </div>

                </aside>

                <div class="col-md-9 container_articles">


                    <div class="col-md-12 bussinessCardF h-100">
                        
                        <div class = "container-fluid bussinessCardBody py-4 px-3">

                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                                
                                <?php foreach($resData as $dt): ?>
                                    <?php
                                    
                                        $id  = $dt->id;
                                        $url = $dt->url;
                                        $imgURL = $dt->imgURL;
                                        $title  = $dt->title;
                                        $price  = $dt->price;
                                        
                                    ?>

                                    <div class="col">
                                        <div class="card">
                                            <a href = "<?= $url; ?>" target = "blank">
                                                <img src="<?= $imgURL; ?>" class="card-img-top" alt="...">
                                            </a>

                                            <div class="card-body">
                                                <h5 class="card-title card-title-min"><?= $title; ?></h5>
                                               
                                                <button type = "button" class = "btn btn-primary mt-3">
                                                    $ <?= number_format($price, 2); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                
                            </div>


                        </div>

                    </div>


                </div>
            </div>

        </div>
    </body>
</html>