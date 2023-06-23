<?php require_once __DIR__ . "/menu_side_controller.php"; ?>
<?php $menuSideController = new MenuSideController(); ?>

<link rel="stylesheet" href="/damask/components/menu_side/styles.css">

<!-- MENU DE NAVEGACIÓN PRINCIPAL DE LA PAGINA -->
<div id = "navigation_menu" class="container-fluid navigation_side p-0">
    <div class = "nav_head">
        <p class = "nav_header_title">Menu</p>
    </div>

    <!-- CONTENIDO DEL MENU PRINCIPAL -->
    <div class="nav_content">
        <?php $menuSideController->renderMenuRoutes(); ?>
    </div>
</div>