<?php

    function getPassRecoveryTemplate(string $usuario, string $tokenURL)
    {
        return "<!DOCTYPE html>
        <html lang='es'>
            <head>
                <link rel='preconnect' href='https://fonts.googleapis.com'>
                <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                <link href='https://fonts.googleapis.com/css2?family=Pacifico&display=swap' rel='stylesheet'>
        
                <style>
                    *
                    {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
        
                    div.mainContent
                    {
                        display: block;
                        width: 100%;
                    }
        
                    div.emailHeader, div.emailFooter
                    {
                        width: 100%;
                        display: block;
                        margin: 0 auto;
                        text-align: center;
                    }
        
                    div.emailHeader h1.emailTitle
                    {
                        color: #fff;
                        padding: 7px 7px 10px 7px;
                        background: #000;
                        font-family: 'Pacifico', cursive;
                    }
        
                    .emailContentContainer
                    {
                        width: 90%;
                        margin-top: 30px;
                        margin-left: auto;
                        margin-right: auto;
                        text-align: center;
                    }
        
                    .emailContent
                    {
                        font-size: 20px;
                        color: rgb(80, 80, 80);
                        text-align: justify;
                    }
        
                    .btnRecoverCredentials
                    {
                        background: rgb(0, 170, 0);
                        margin-top: 40px;
                        outline: none;
                        border: none;
                        cursor: pointer;
                        padding: 14px 25px;
                        border-radius: 8px;
                        color: white;
                        font-size: 16px;
                    }
        
                    .emailFooter
                    {
                        margin-top: 40px !important;
                        background: #000;
                        padding: 30px;
                        color: #fff;
                    }
        
                    body
                    {
                        background: rgb(250, 250, 250);
                    }
                </style>
            </head>
        
            <body>
                <div class='mainContent'>
                    <div class='emailHeader'>
                        <h1 class='emailTitle'>Damask / Recuperar Contraseña</h1>
                    </div>
        
                    <div class='emailContentContainer'>
                        <p class='emailContent'>
                            <strong><i>Atención!</i></strong>, Se ha solicitado una operacion para recuperación de credenciales de usuario
                            <b>$usuario</b>, 
                            si usted no ha solicitado el cambio porfavor haga caso omiso al mensaje. <br><br><br>
        
                            En caso de <b>SI</b> haber solicitado este cambio porfavor ingrese al siguiente link usando el
                            boton a continuación:
                        </p>
        
                        <a href='$tokenURL' target='_blank'>
                            <button class = 'btnRecoverCredentials'>Recuperar</button>
                        </a>
                    </div>
        
                    <div class='emailFooter'>
                        <copy>&copy <i><author>Brayan Steven Garcia</author></i> - Damask 2023 - Todos los derechos reservados</copy>
                    </div>
                </div>
            </body>
        </html>";
    }

?>