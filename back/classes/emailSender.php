<?php

    require_once __DIR__ . "/response.php";
    require_once __DIR__ . "/../../globals/globals.php";
    require_once __DIR__ . "/../utils/utils.php";
    require_once __DIR__ . "/../validations/filterValidator.php";
    require_once __DIR__ . "/email_html_templates/password_recovery.php";

    define("RECOVERY_URL", "http://$serverHost/damask/password_recovery/token/");

    class EmailSender
    {
        private string $name = "Damask Admin";
        private string $from = "admdmsk1234@hotmail.com";

        private string $to;
        private string $subject;
        private string $htmlMsg;
        private string $mailHeaders;

        private FilterValidator $fv;

        public function __construct($to = "", $subject = "", $htmlMsg = "", $mailHeaders = "")
        {
            $this->fv = new FilterValidator();

            $this->setDestination($to)
                 ->setSubject($subject)
                 ->setHtmlMsg($htmlMsg)
                 ->setMailHeaders($mailHeaders);

            if(empty($mailHeaders))
                $this->configDefaultHeaders();
        }

        /**************************************** GETTERS Y SETTERS ****************************************/
        public function getDestination() : string
        {
            return $this->to;
        }

        public function setDestination(string $to)
        {
            $this->to = $to;

            return $this;
        }

        public function getSubject() : string
        {
            return $this->subject();
        }

        public function setSubject(string $subject)
        {
            $this->subject = $subject;

            return $this;
        }

        public function getHtmlMsg() : string
        {
            return $this->htmlMsg;
        }

        public function setHtmlMsg(string $htmlMsg)
        {
            $this->htmlMsg = $htmlMsg;

            return $this;
        }

        public function getMailHeaders() : string
        {
            return $this->mailHeaders;
        }

        public function setMailHeaders(string $mailHeaders)
        {
            $this->mailHeaders = $mailHeaders;

            return $this;
        }
        /************************************* FIN GETTERS Y SETTERS *************************************/

        public function configDefaultHeaders()
        {
            $mailHeaders  = 'MIME-Version: 1.0' . "\r\n";
            $mailHeaders .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $mailHeaders .= "From: $this->name<$this->from>" . "\r\n" . 'X-Mailer: PHP/' . phpversion();

            $this->mailHeaders = $mailHeaders;
        }

        public function fillAndGetRecoveryPasswordTemplate(string $usuario, $token) : string
        {
            $tokenURL = RECOVERY_URL . "?token=$token";

            $this->htmlMsg = getPassRecoveryTemplate($usuario, $tokenURL);

            return $this->htmlMsg;
        }

        public function send() : Response
        {
            $resp = new Response();

            $email       = $this->to;
            $subject     = $this->subject;
            $msgHTML     = $this->htmlMsg;
            $mailHeaders = $this->mailHeaders;
            
            if(($email && $subject) && !empty($email) && !empty($subject)){
        
                $email = $this->fv->filterEmail($email);
                $subject = $this->fv->filterString($subject);
        
                //Sending the email...
                $resultadoCorreoEnviado = mail($email, $subject, $msgHTML, $mailHeaders);

                if($resultadoCorreoEnviado)
                {
                    $resp->setStatus(true);
                    
                    $resp->setMsg(
                        "Se le ha enviado un correo electronico para cambiar su contraseña " .
                        "porfavor verifique su bandeja de entrada y spam!"
                    );
                }
                else
                    $resp->setMsg("Ha ocurrido un error al enviar el correo!");
            }
            else
                $resp->setMsg("Hay información obligatoria vacia o no valida, por favor verifique!");

            return $resp;
        }

    }

    /*$emailSender = new EmailSender("b.rayan991@hotmail.com", "Recuperación de contraseña");
    $emailSender->fillAndGetRecoveryPasswordTemplate("Brayan", "ExToken");

    print_r($emailSender->send());*/

?>