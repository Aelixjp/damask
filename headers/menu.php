<?php include_once "menu_config.php"; ?>

<div class="navbar navbar-expand-lg cardHeader px-3 py-2">
    <div class="container-fluid">
        <a href="<?= APP_LOCAL . "/" . "articles"; ?>" class = "menuTitleCont">
            <h2 class="menuTitle ms-2">Damask</h2>
        </a>

        <div class="collapse navbar-collapse text-decoration-none ms-5" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach($menu_routes as $k => $route): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $route['url']; ?>"><?= $route['name']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="d-flex me-3 align-items-center w-40">
            <!--<input class="form-control searchBar" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-success me-5" type="submit">
                <i class="bi bi-search"></i>
            </button>-->

            <div class="d-flex align-items-center justify-content-center position-absolute contAvatar">
                <span class="avatarUsername mx-4"><?= $_SESSION["name"]; ?></span>

                <div id = "avatarImg" class="avatarImg d-inline-block">
                    <i class="bi bi-person-circle"></i>
                </div>

                <div id = "displayMenuIcon" class="displayMenuIcon d-none ms-3">
                    <i class="bi bi-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>