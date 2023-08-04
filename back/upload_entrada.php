<?php 
require_once('funciones.php');
if(!empty($_POST['titulo']) && !empty($_POST['contenido']) && !empty($_POST['categorias']) && !empty($_FILES['imagen'])){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];

$categorias=$_POST['categorias'];
$categorias=join(',',$categorias);

$img=$_FILES['imagen'];

$resultado=crear_entrada($titulo,$contenido,$img,'1',$categorias); //subida

//armado de consulta de regreso por GET
if(is_string($resultado)){ //exito
    header("refresh:1;http://localhost/php-sql/views/crear_entrada.php?resultado=$resultado");
}elseif(is_array($resultado)){ //error
    session_start();
    $_SESSION['resultado']=$resultado;
    header("crear_entrada.php");
}
}
?>