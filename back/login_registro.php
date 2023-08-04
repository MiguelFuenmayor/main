<?php 
//recibir datos desde Post para ingresarlos en la función LOGIN
if(!empty($_POST['mail']) && !empty($_POST['contrasena']) && empty($_POST['nombre']))
{$mail=$_POST['mail']; $contrasena=$_POST['contrasena'];
$login=registro_login($mail,$contrasena);

    if(is_string($login)){
        header('refresh:1;index.php?login='.$login); //RESULTADO LOGIN MALO --STRING--
    }
    if(is_array($login)){
        session_start();
        $_SESSION['user']=$login;   //RESULTADO LOGIN BUENO --ARRAY--
        header('refresh:1;index.php'); 
    }
}
//registro REGISTRO

elseif(!empty($_POST['mail']) && !empty($_POST['contrasena']) && !empty($_POST['nombre'])){
    $mail=$_POST['mail']; $contrasena=$_POST['contrasena']; $nombre=$_POST['nombre'];
    $registro=registro_login($mail,$contrasena,$nombre);
    if(is_string($registro)){
        //exito
        header('refresh:1;index.php?registro='.$registro); //RESULTADO REGISTRO BUENO --STRING--
    }
    elseif(is_array($registro)){
        //error
        session_start();
        $_SESSION['error']=$registro;   //RESULTADO REGISTRO MALO --ARRAY--
        header('refresh:1;index.php');
    }
}
?>