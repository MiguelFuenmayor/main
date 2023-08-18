<?php 

if(!empty($_SESSION['user'])){
if(!empty($_POST['titulo']) && !empty($_POST['contenido']) && !empty($_POST['categorias']) && !empty($_FILES['imagen'])){
$titulo=$_POST['titulo'];
$contenido=$_POST['contenido'];
$user_id=$_SESSION['user']['id'];
$categorias=$_POST['categorias'];
$categorias=join(',',$categorias);

$img=$_FILES['imagen'];

$resultado=crear_entrada($titulo,$contenido,$img,$user_id,$categorias); //subida

//armado de consulta de regreso por GET
if(is_string($resultado)){ //exito
    header("refresh:1;crear_entrada.php?resultado=$resultado");
}elseif(is_array($resultado)){ //error
    session_start();
    $_SESSION['resultado']=$resultado;
    header("refresh:1;crear_entrada.php");
}
}}elseif(empty($_SESSION['user'])){
    header("location:user.php?crear=1");
}
?>