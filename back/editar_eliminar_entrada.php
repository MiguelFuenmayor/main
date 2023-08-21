<?php
$entrada=[];
    !empty($_POST['id']) ? $entrada['id']=$_POST['id'] : $entrada=[];
    !empty($_POST['user_id']) ? $entrada['user_id']= $_POST['user_id'] :$entrada=[];
    !empty($_POST['titulo']) ? $entrada['titulo']= $_POST['titulo'] :   $entrada=[];
    !empty($_POST['desc']) ? $entrada['desc']= $_POST['desc'] :         $entrada=[];
    !empty($_FILES['img_url']) ? $entrada['img_url']=  $_FILES['img_url'] :      $entrada=[];
    !empty($_POST['categorias']) ? $entrada['categorias']= $_POST['categorias'] :  $entrada=[];
if(!empty($_POST['user_id']) && !empty($entrada['user_id'])){
$entrada= $entrada['user_id']==$_SESSION['user']['id'] ? $entrada : false;}
 if(count($entrada)==6){
    $result=editar_eliminar_entradas(
    $entrada['id'],$entrada['titulo'],$entrada['desc'],$entrada['categorias'],$entrada['img_url']);
    }
    elseif(count($entrada)==1){
        $result=editar_eliminar_entradas($entrada['accion'],$entrada['id']);
    }