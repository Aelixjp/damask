export const serverHost = "localhost";

export function checkSecurePassword(password)
{
    /*
    La contraseña Debe contener minimo:
    
    - 1 Caracter especial
    - 1 Caracter alfabetico mayusculo y 1 minusculo
    - 1 numero
    - Debe tener minimo 10 caracteres maximo 20
    - No puede tener espacios en blanco
    */
    const safePasswordRegex =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,20}$/; ;

    return safePasswordRegex.test(password);
}

export function checkPasswords(password, passwordConf)
{
    if(typeof password != "string" && typeof passwordConf != "string")
        return false;
    else if(password.trim() === "" || passwordConf.trim() === "")
        return false;
    else if(password.length < 8)
        return false;
    else if(password != passwordConf)
        return false;
    else if(!checkSecurePassword(password))
        return false;

    return true;
}

export const checkEmail = email => (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/).test(email);