<?php
    require_once "../globals/globals.php";
    require_once "../back/validations/security.php";
    require_once "../back/pages/pages.php";

    setlocale(LC_MONETARY, 'es_CO');

    $resData = [];
    $colors = ["bg-primary", "bg-danger", "bg-warning"];

    $id_usr = $_SESSION["ID"];
    $e_commerces = getPages();

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

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="module" src="main.js"></script>

        <title>Articles</title>
    </head>

    <body class = "bg-light position-relative d-block w-100 h-100">
        <?php require_once "../headers/menu.php"; ?>
        <?php require_once "../components/menu_side/menu_side.php"; ?>
        <?php require_once "../components/modals/comparar_productos_detalle/index.php"; ?>
        <?php require_once "../components/modals/comparar_productos/index.php"; ?>
        <?php require_once "../components/loader/index.php"; ?>

        <input type="number" name="usr_id" id="usr_id" value="<?= $id_usr; ?>" style="display: none;">

        <div class="container-fluid contentBody px-0">
            <div class="row w-100 h-100">
                <aside class="col-md-3 h-100 bg-side p-4">
                    <!-- INPUT PRODUCTO -->
                    <div class="form-group">
                        <label for="buscarProducto">Buscar Producto</label>
                        <input type="text" class="form-control" id="buscarProducto" aria-describedby="emailHelp" placeholder="Producto...">
                    </div>

                    <!-- INPUT PRECIO MINIMO -->
                    <div class="form-group">
                        <label for="minPrecio">Precio minimo:</label>
                        <input type="number" class = "form-control" name="minPrecio" id="minPrecio" aria-describedby="minPrecio"
                        min = "0" placeholder = "Minimo...">
                    </div>

                    <!-- INPUT PRECIO MAXIMO -->
                    <div class="form-group">
                        <label for="maxPrice">Precio maximo:</label>
                        <input type="number" class = "form-control" name="maxPrice" id="maxPrice" aria-describedby="maxPrice"
                        min = "0" placeholder = "Maximo...">
                    </div>

                    <!-- INPUT CANTIDAD PRODUCTOS -->
                    <div class="form-group">
                        <label for="searchSize">Cantidad Filtrar por E-COMMERCE:</label>
                        <input id = "searchSize" type="number" class = "form-control" name="searchSize" aria-describedby="searchSize"
                        min = "20" value = "20" placeholder = "Cantidad Filtrar...">
                    </div>

                    <div class="form-group">
                        <label for="commerceType">E commerce:</label>

                        <!-- SELECT E-COMMERCE-->
                        <select name="commerceType" id="commerceType" class = "form-select">
                            <option value="0">Seleccione e-commerce...</option>

                            <?php foreach($e_commerces as $page): ?>
                                <?php
                                    $id = $page["ID"];
                                    $nombre = $page["nombre"];
                                    $status = $page["status"];
                                ?>

                                <?php if ($status): ?>
                                    <option value = "<?= $id; ?>"><?= $nombre; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group text-center mt-5">
                        <!-- BOTON FILTRAR -->
                        <button id = "btnFiltrar" type = "button" class = "btn btn-primary">Buscar</button>
                    </div>
                </aside>

                <div class="col-md-9 container_articles">
                    <div class="col-md-12 bussinessCardF h-100">
                        <div class = "container-fluid bussinessCardBody py-4 px-3">
                            <h2 class="titlePag text-center text-decoration-underline my-3 mb-5">Buscar Articulos</h2>

                            <div id = "containerHeaderBtns" class="containerHeaderBtns d-none mb-5 mt-4">
                                <button type="button" class="btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#modalCompProducto">Comparar Productos</button>
                                
                                <nav id = "mainPag" aria-label="Page navigation example" class="me-5">
                                    <ul class="pagination mb-0">
                                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">50</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <div id = "noDisplayContent" class="noDisplayContent text-center">
                                <img class="imgNoContent" src="/damask/src/images/app_images/briefcase_portafolio.png" alt="">
                                
                                <div class="noDisplayContentContainer mt-5 text-secondary">
                                    <p>¡Nada por aqui!, busque un producto para comenzar...</p>
                                </div>
                            </div>
                        
                            <div id = "contCards" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                                <?php foreach($resData as $dt): ?>
                                    <?php
                                    
                                        $id     = $dt->id;
                                        $pageID = $dt->pageID;
                                        $url    = $dt->url;
                                        $imgURL = $dt->imgURL;
                                        $title  = $dt->title;
                                        $price  = $dt->price;
                                        
                                        $color     = $colors[$pageID - 1];
                                        $ecommerce = $e_commerces[$pageID - 1]["nombre"];
                                    ?>

                                    <div class="col">
                                        <div class="card">
                                            <div class = "cardHead <?= $color; ?>">
                                                <p class = "cardHeadTitle"><?= $ecommerce; ?></p>
                                            </div>

                                            <a href = "<?= $url; ?>" target = "blank">
                                                <img src="<?= $imgURL; ?>" class="card-img-top" alt="...">
                                            </a>

                                            <div class="card-body">
                                                <h5 class="card-title card-title-min"><?= $title; ?></h5>
                                               
                                                <div class="containerCardFooter fixedBottom">
                                                    <!-- Boton de precio -->
                                                    <div class="priceSection">
                                                        <button type = "button" class = "btn btn-primary mt-3">
                                                            $ <?= number_format($price, 2); ?>
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
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/damask/frameworks/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>