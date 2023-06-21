<?php

    class MenuSideController
    {

        const APP_NAME = "/damask";

        const MENU_SIDE_ROUTES = 
        [
            [
                "url" => MenuSideController::APP_NAME . "/articles",
                "title" => "Inicio",
                "icon" => "bi bi-house-door-fill"
            ],
            [
                "url" => MenuSideController::APP_NAME . "/back/articles/my_articles.php",
                "title" => "Mis Articulos",
                "icon" => "bi bi-bag-heart"
            ],
            [
                "url" => MenuSideController::APP_NAME . "/back/validations/logout.php",
                "title" => "Salir",
                "icon" => "bi bi-box-arrow-in-left"
            ]
        ];

        function __construct(){}

        function renderMenuRoutes()
        {
            foreach(MenuSideController::MENU_SIDE_ROUTES as $menuRoute)
            {
                $url = $menuRoute["url"];
                $icon = $menuRoute["icon"];
                $title = $menuRoute["title"];

                echo "<ul>
                    <a href='$url'>
                        <div class='menu_ic'>
                            <i class='$icon'></i>

                            <li>$title</li>
                        </div>
                    </a>
                </ul>";
            }
        }

    }

?>