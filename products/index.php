<?php
    require_once "../globals/globals.php";
    require_once "../back/validations/security.php";
    require_once "../back/pages/pages.php";
    require_once "../back/products/products.php";

    $id_usr = $_SESSION["ID"];
    $user_products = getUserProducts($id_usr);

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

        <script type="module" src="main.js"></script>

        <title>Articles</title>
    </head>

    <body class = "bg-light position-relative d-block w-100 h-100">
        <?php require_once "../headers/menu.php"; ?>
        <?php require_once "../components/menu_side/menu_side.php"; ?>

        <section class="main_content container-fluid px-0 w-100 h-100">
            <div class="row w-100">
                <h1 class="title_articles">Mis Articulos</h1>
            </div>

            <div id = "container-articulos" class="container-fluid content-articulos mx-auto text-center rounded">
                <div class="row p-4">
                    <?php foreach($user_products->getData() as $usr_product): ?>
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
                                <div class = "cardHead bg-primary">
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

                                            <button class = "btn btn-danger" type = "button">
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
    </body>
</html>