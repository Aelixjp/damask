<?php
    require_once "../globals/globals.php";
    require_once "../back/validations/security.php";
    require_once "../back/pages/pages.php";
    require_once "../back/products/products.php";

    $id_usr = $_SESSION["ID"];
    $user_products = getUserProducts($id_usr);
    $user_products_data = $user_products->getData();

    $colors = [
        "bg-primary",
        "bg-danger",
        "bg-warning"
    ];

    $e_commerces = getPages();

    setlocale(LC_MONETARY, 'es_CO');

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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="module" src="main.js"></script>

        <title>Articles</title>
    </head>

    <body class = "bg-light position-relative d-block w-100 h-100">
        <?php require_once "../headers/menu.php"; ?>
        <?php require_once "../components/menu_side/menu_side.php"; ?>
        <?php require_once "../components/modals/comparar_productos_detalle/index.php"; ?>
        <?php require_once "../components/modals/comparar_productos/index.php"; ?>

        <section class="main_content container-fluid px-0 w-100 h-100">
            <div class="row w-100">
                <h1 class="title_articles">Mis Articulos</h1>
            </div>

            <div id = "container-articulos" class="container-fluid content-articulos mx-auto text-center rounded">
                <div id = "containerMyArticles" class="row p-4">
                    <div id = "noContentContainer" class="noContentContainer text-secondary <?= empty($user_products_data) ? '' : 'd-none'; ?>">
                        <h2 class = "titleNoContent">Empieza guardando algún articulo!</h2>
                        <p class = "textNoContent">¡Aquí apareceran los articulos que hayas guardado!</p>
                    </div>

                    <!-- Contenedor de filtros y busqueda -->
                    <div id = "artFilters" class="artFilters mb-4 <?= empty($user_products_data) ? 'd-none' : ''; ?>">
                        <!-- Contenedor filtro por e-commerce -->
                        <div class="filterByEcommerceCont form-group d-flex">
                            <div class="input-group-append d-inline-block me-5">
                                <label class="me-3" for="commerceType">Filtrar por e-commerce:</label>

                                <!-- SELECT E-COMMERCE-->
                                <select name="commerceType" id="commerceType" class = "form-select w-auto d-inline-block">
                                    <option value="0">Todos</option>

                                    <?php foreach($e_commerces as $page): ?>
                                        <?php
                                            $id     = $page["ID"];
                                            $nombre = $page["nombre"];
                                            $status = $page["status"];
                                        ?>

                                        <?php if ($status): ?>
                                            <option value = "<?= $id; ?>"><?= $nombre; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Contenedor barra de busqueda -->
                            <div class="input-group-append d-flex align-items-center">
                                <label for="buscarArticulo" class="me-3">Buscar articulo...</label>
                                <input id ="inpSearch" type="search" name="buscarArticulo" class="form-control border-end-0 rounded-0 rounded-start w-auto" placeholder="Buscar Articulo" aria-label="Buscar Articulo" aria-describedby="basic-addon2">

                                <button id="searchBtn" class="btn btn-primary d-inline-block w-0 rounded-0 rounded-end" type="button">
                                    <i class = "bi bi-search"></i>
                                </button>

                                <button type="button" class="btn btn-danger ms-5"
                                data-bs-toggle="modal" data-bs-target="#modalCompProducto">Comparar Productos</button>
                            </div>
                        </div>
                    </div>

                    <div id="noEcommerceFilter" class="noContentContainer text-secondary d-none">
                        <h2 class = "titleNoContent">Oops!</h2>
                        <p class = "textNoContent">No hay articulos para mostrar!</p>
                    </div>

                    <?php foreach($user_products_data as $usr_product): ?>
                        <?php
                            $product_id = $usr_product["ID"];
                            $url_article = $usr_product["url"];
                            $nombre_article = $usr_product["nombre_producto"];
                            $imagen_article = $usr_product["imagen_producto"];
                            $precio_article = $usr_product["precio_producto"];
                            $review_article = $usr_product["resena_producto"];

                            $page = $usr_product["pagina"];

                            $page_id = $page["ID"];
                            $page_name = $page["nombre"];
                        ?>

                        <div class="col-sm-3 mb-3">
                            <div id = "product_<?= $product_id ?>" class="card">
                                <div class = "cardHead <?= $colors[$page_id - 1]; ?>">
                                    <p page-id = "<?= $page_id ?>" class = "cardHeadTitle"><?= $page_name ?></p>
                                </div>

                                <a href = "<?= $url_article ?>" target = "blank">
                                    <img src="<?= $imagen_article ?>" class="card-img-top" alt="...">
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title card-title-min"><?= $nombre_article ?></h5>

                                    <hr>

                                    <div class="product_review"><?= $review_article ?></div>
                                    
                                    <div class="containerCardFooter fixedBottom">
                                        <!-- Boton de precio -->
                                        <div class="priceSection">
                                            <button type = "button" class = "btn btn-primary mt-3">
                                                $ <?= number_format($precio_article, 2); ?>
                                            </button>
                                        </div>

                                        <!-- Botones adicionales de funciones para cada tarjeta  -->
                                        <div class="cardBtnsSection">
                                            <button class = "btn btn-warning btn-my-articles" type = "button">
                                                <i class="bi bi-star-fill text-white"></i>
                                            </button>

                                            <button
                                                attr-url = '<?= $url_article; ?>'
                                                attr-title = '<?= $nombre_article; ?>'
                                                attr-price = '<?= $precio_article; ?>'
                                                attr-page-id = '<?= $page_id; ?>'
                                                attr-ecommerce = '<?= $page_name; ?>'
                                                attr-image-url = '<?= $imagen_article; ?>' 
                                                class = "btn btn-danger btnCompareArt" type = "button">
                                                <i class="bi bi-arrow-left-right text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <script src="/damask/frameworks/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>