<?php 
if($_GET['login']){
    $error_login=$_GET['login'];
    unset($_GET['login']);
}elseif($_GET['registro']){
    $exito_registro=$_GET['registro'];
    unset($_GET['registro']);
}elseif($_SESSION['error']){
    $errores=$_SESSION['error']; //DEBES TERMINAR DE RECIBIR TODOS LOS RESULTADOS DE login_registro.php
}

require_once('views/head.php');
require_once('views/Menu.php');
require_once('views/lateral.php'); ?>
<div id='contenido'> 
         
    </div>    <!-- FIN CONTENIDO -->


<?php  
require_once('views/pie.php'); ?>