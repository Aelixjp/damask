<!DOCTYPE html>
<html lang="es" class="d-block w-100 h-100">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <?php require_once "globals/globals.php"; ?>
        <?php require_once "globals/links/links.php"; ?>

        <script type="module" src="main.js"></script>
    </head>
    
    <body class="d-block w-100 h-100">
        <div class="container-fluid d-block w-100 h-100">
            <div class="row h-100">
                <div class="container-login col-md-5 d-flex flex-column justify-content-start bg-light border-marine">
                    <div class="d-inline-block mx-5 form-top-extra">
                        <h1 class="mainTitle mb-3">Damask</h1>

                        <p class="titleLegend mb-3">Busca y compara productos de tu interes rapidamente en tus tiendas favoritas!</p>
    
                        <form id = "formLogin" action="" class="w-100 bg-form form-log form-top"
                        method="POST">
                            <div class="cardHeader px-3 py-3">Iniciar sesión</div>

                            <div class="cardBody p-4">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input id = "inpUsername" name="username" type="text" class="form-control" required>
                                </div>
    
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id = "inpPassword" name="password" type="password" class="form-control" required>
                                </div>

                                <div class="form-group text-center">
                                    <a href="/damask/register" class="recover-p">Aún no tienes cuenta?, Registrate Aquí!</a>
                                </div>

                                <div class="form-group text-center">
                                    <a href="/damask/password_recovery" class="recover-p">Olvidaste tu cuenta?, Recuperala Aquí!</a>
                                </div>

                                <div class="form-group text-center mt-4 mb-4">
                                    <button id = "btnLogin" type="button" class="btn btn-submit-login mt-2">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-7 bussinessCard h-100"></div>
            </div>
        </div>

        <script src="/damask/frameworks/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>