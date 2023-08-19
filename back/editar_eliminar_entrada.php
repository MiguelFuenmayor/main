<?php
$entrada=[];
$entrada['id']= !empty($_POST['id']) ? $_POST['id'] : $entrada=false;
$entrada['user_id']= !empty($_POST['user_id']) ? $_POST['user_id'] : $entrada=false;
$entrada['titulo']= !empty($_POST['titulo']) ? $_POST['titulo'] : $entrada=false;
$entrada['desc']= !empty($_POST['desc']) ? $_POST['desc'] : $entrada=false;
$entrada['img_url']= !empty($_FILES['img']) ? $_FILES['img'] : $entrada=false;
$entrada['categorias']= !empty($_POST['categorias']) ? $_POST['categorias'] : $entrada=false;
$entrada['accion']= !empty($_POST['accion']) ? $_POST['accion'] : false;
$entrada= $entrada['user_id']==$_SESSION['user']['id'] ? $entrada : false;
 if($entrada!==false && $entrada['accion']=='ed'){
    $result=editar_eliminar_entradas($entradas['accion'],
    $entrada['id'],$entrada['titulo'],$entrada['desc'],$entrada['categorias'],$entrada['img_url']);
    }
    elseif($entrada!==false && $entrada['accion']=='el'){
        $result=editar_eliminar_entradas($entrada['accion'],$entrada['id']);
    }