<?php
    header('Access-Control-Allow-Origin: localhost');

    /**Filtra y sanea información ademas de validar cosas como strings, correos, telefonos, URL's, etc,
        Previene cosas como inyección de código SQL y es útil en general para la seguridad.
    */
    class FilterValidator{

        /**Filtra y remueve todo tipo de caracteres especiales asi como espacios al inicio y al final de la cadena, 
            exceptuando barras invertidas (\\), convierte entidades HTML en texto para que no se interpreten.
        */
        function filterString($string){

            $str = $string;
            $str = trim($str);
            $str = htmlspecialchars($str);

            return $str;

        }

        /**Realiza lo mismo que filterString, pero remueve las barras invertidas (\\)*/
        function strictFilterString($string){
            $str = stripcslashes($string);
            $str = $this->{'filterString'}($str);

            return $str;
        }

        /**Valida un correo electronico realizando primeramente diferentes operaciones como:

            - Eliminar espacios al inicio y al final
            - Eliminar backslashes (\\)
            - Convertir caracteres en entidades HTML
            - Sanear el correo electronico para quitar cualquier caracter no admitido por un servicio de correo electronico
        */
        function filterEmail($email){

            $validEmail = trim($email);
            $validEmail = stripcslashes($validEmail);
            $validEmail = htmlspecialchars($validEmail);
            $validEmail = filter_var($validEmail, FILTER_SANITIZE_EMAIL);

            return $validEmail;

        }

        /**Valida un numero de telefono usando una expresión regular muy potente, la expresión regular valida que:

            - El numero de telefono comience con el signo más (+) y que seguido a el haya un numero o más (dependiendo).
            - Que el código del país tenga como minimo un digito y como maximo 3, es decir, 0-999 y luego haya un espacio
            - Que seguido del código del país hayan 3 digitos seguidos de 1 espacio, otros 3 seguidos de otro, 2 mas seguidos de un
              espacio y dos ultimos más al final.

            Teniendo entonces que los unicos formatos aceptados y validos compuestos por esta expresión regular son:
            
            - +0 000 000 00 00
            - +00 000 000 00 00
            - +000 000 000 00 00
        */
        function filterPhone($number){
            $pattern = '/^\+([0-9]{1,3})( )([0-9]{3})( )([0-9]{3})( )([0-9]{2})( )([0-9]{2})$/';

            //En caso de que haya mas de una expresión regular, deberia meterse en el arreglo, para hacerla valida
            $patterns = array($pattern);

            /*
                Recorremos las expresiones regulares que validan nuestro numero y si alguna coincide devolvemos el numero telefonico,
                de lo contrario devolvemos false.
            */
            foreach($patterns as $currPattern)
                if(preg_match($currPattern, $number)) return $number;

            return false;
        }

        /**Filtra y saneamos una URL para validar si tiene un formato adecuado, devuelve false en caso de que no tenga un formato valido.*/
        function filterURL($URL){
            $validURL = trim($URL);
            $validURL = filter_var($URL, FILTER_SANITIZE_URL);

            return $validURL;
        }

        /**Valida si lo introducido es un numero o una simple cadena de texto, en caso de ser una cadena de texto con solo numeros intentara
            convertirla a un numero ya sea flotante o entero.
        */
        function filterNumber($num){
            try {

                if(gettype($num) != "integer" && gettype($num) != "float"){
                    
                    $cnum = filter_var($num, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    return $cnum != $num || (empty($cnum) && $cnum !== "0") ? false : $cnum + 0;

                }else if(gettype($num) == "string"){
                    return $num;
                }else{
                    return false;
                }

            } catch (\Throwable $th) {
                return false;
            }
        }

        /**Valida una fecha con el formato: dd/mm/yyyy, en caso de tener el formato adecuado devuelve la fecha, caso contrario devuelve false*/
        function filterDate($date){
            return boolval(preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $date)) ? $date : false;
        }

        /**Wrapper que ejecuta alguno de los filtros dependiendo del tipo especificado*/
        function filterByType($val, $type){
            switch($type){
                case "url":
                    return $this->filterURL($val);

                case "date":
                    return $this->filterDate($val);

                case "text":
                    return $this->strictFilterString($val);

                case "number":
                    return $this->filterNumber($val);

                case "email":
                    return $this->filterEmail($val);

                default:
                    return $val;
            }
        }

    }

?>