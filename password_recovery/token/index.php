<?php

    require_once "../../back/classes/response.php";
    require_once "../../back/classes/extendedResponse.php";
    require_once "../../back/DAO/DAOToken.php";
    require_once "../../back/connection/connection.php";
    require_once "../../back/validations/filterValidator.php";

    $fv = new FilterValidator();
    $resp = new ExtendedResponse();
    $token = "";

    function checkMethod()
    {
        return $_SERVER["REQUEST_METHOD"] == "GET";
    }

    function checkEmptyToken()
    {
        global $fv;
        global $token;

        if(!isset($_GET["token"]))
            return false;
        else if(empty(trim($_GET["token"])))
            return false;
        else
        {
            $token = $fv->strictFilterString($_GET["token"]);

            return true;
        }
    }

    function checkValidToken()
    {
        global $conn;
        global $token;

        $daoToken = new DAOToken($conn);
        $tokenDT = $daoToken->getToken($token);

        return $tokenDT->getStatus();
    }

?>

<!DOCTYPE html>
<html lang="es" class="d-block w-100 h-100">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambiar Contraseña</title>

        <?php require_once "../../globals/globals.php"; ?>
        <?php require_once "../../globals/links/links.php"; ?>

        <link rel="stylesheet" href="<?= LIBRARIES_URL_LOCAL; ?>/bootstrap-icons/font/bootstrap-icons.css">

        <link rel="stylesheet" href="styles.css">

        <script type="module" src="main.js"></script>
    </head>
    
    <body class="d-block w-100 h-100">  
        <div class="container-fluid d-block w-100 h-100">
            <div class="row h-100">
                <div class="container-login col-md-12 d-flex justify-content-center bg-light border-marine">
                    <div class="position-relative d-inline-block mx-5 form-top-extra">
                        <div class="header_translucid">
                            <h1 class="mainTitle mb-3">Damask</h1>

                            <p class="titleLegend mb-3">Busca y compara productos de tu interes rapidamente en tus tiendas favoritas!</p>
                        </div>

                        <?php if(!checkMethod()): ?>
                            <div class="emptyTokenContainer">
                                <div class="cardHeaderError px-3 py-3 text-center">ERROR / METODO NO AUTORIZADO</div>

                                <div class="cardBody p-4 cardBodyError">
                                    <p class="cardBodyContent">
                                        Peticion no valida, a continuación puede volver a la pantalla principal usando el boton:
                                    </p>

                                    <a href = "/damask/">
                                        <button class="btn btn-primary btnError">
                                            <i class="bi bi-arrow-left-circle me-3"></i>Volver
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php elseif(!checkEmptyToken()): ?>
                            <div class="emptyTokenContainer">
                                <div class="cardHeaderError px-3 py-3 text-center">ERROR / TOKEN NO ESPECIFICADO</div>

                                <div class="cardBody p-4 cardBodyError">
                                    <p class="cardBodyContent">
                                        No ha sido especificado un token valido para cambio de contraseña,
                                        a continuación puede volver a la pantalla principal usando el boton:
                                    </p>

                                    <a href = "/damask/">
                                        <button class="btn btn-primary btnError">
                                            <i class="bi bi-arrow-left-circle me-3"></i>Volver
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php elseif(!checkValidToken()): ?>
                            <div class="emptyTokenContainer">
                                <div class="cardHeaderError px-3 py-3 text-center">ERROR / TOKEN INVALIDO</div>

                                <div class="cardBody p-4 cardBodyError">
                                    <p class="cardBodyContent">
                                        El token especificado para cambio de contraseña no es valido o ha expirado!,
                                        a continuación puede volver a la pantalla principal usando el boton:
                                    </p>

                                    <a href = "/damask/">
                                        <button class="btn btn-primary btnError">
                                            <i class="bi bi-arrow-left-circle me-3"></i>Volver
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <form id = "formRecoverPassword" action="" class="w-100 bg-form form-log"
                            method="POST">
                                <div class="cardHeader px-3 py-3">Cambiar Contraseña</div>

                                <div class="cardBody p-4">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input id = "inpPassword" name="password" type="password" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="passwordConf">Confirmar Contraseña</label>
                                        <input id = "inpPasswordConf" name="passwordConf" type="password" class="form-control" required>
                                    </div>

                                    <div class="form-group text-center mt-4 mb-3">
                                        <button id = "btnRecoverPass" type="button" class="btn btn-submit-login mt-2">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>

        <script src="/damask/frameworks/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>