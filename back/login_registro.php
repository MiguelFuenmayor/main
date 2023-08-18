<?php 
session_start();
//recibir datos desde Post para ingresarlos en la función LOGIN
if(!empty($_POST['mail']) && !empty($_POST['contrasena']) && empty($_POST['nombre']))
{$mail=$_POST['mail']; $contrasena=$_POST['contrasena'];

$login=registro_login($mail,$contrasena);

    if(is_string($login)){
        header('location:http://localhost/php-sql/user.php?accion=1&login='.$login); //RESULTADO LOGIN MALO --STRING--
    }
    if(is_array($login)){
        
        $_SESSION['user']=$login;   //RESULTADO LOGIN BUENO --ARRAY--
        header('location:http://localhost/php-sql/index.php'); 
    }
}
//registro REGISTRO

elseif(!empty($_POST['mail']) && !empty($_POST['contrasena']) && !empty($_POST['nombre'])){
    $mail=$_POST['mail']; $contrasena=$_POST['contrasena']; $nombre=$_POST['nombre'];

    $registro=registro_login($mail,$contrasena,$nombre);
    if(is_string($registro)){
        //exito
        header('location:http://localhost/php-sql/user.php?registro='.$registro); //RESULTADO REGISTRO BUENO --STRING--
    }
    elseif(is_array($registro)){
        //error
        $_SESSION['error']=$registro;   //RESULTADO REGISTRO MALO --ARRAY--

        header('location:http://localhost/php-sql/user.php?accion=2');
    }
}

if(!empty($_GET['outlogging'])){
    
    unset($_SESSION['user']);
    
    header('location:http://localhost/php-sql/index.php');
}
?>