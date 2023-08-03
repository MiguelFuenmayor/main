
<?php $entradas=(empty($_POST['search'])) ? obtener_entradas() : obtener_entradas(false,false,$_POST['search']);
$entradas=(empty($_GET['category'])) ? obtener_entradas() : obtener_entradas(false,false,false,$_GET['category']);
 foreach($entradas as $entrada) :  
 $autor=obtener_autor($entrada[2]);
 $categorias=obtener_categorias($entrada[1]);  ?>

<div id="preview">
    <a href="index?main=<?=$entrada[0]?>">
    <img width="300px" src="<?=$entrada[5]?>" alt="img">
    <h3><?=$entrada[3]?></h3>
    <h6 id="info-preview"><?=$autor?> - <?=$entrada[6]?> - <?=$categorias?></h6>
    </a>
</div>
<?php endforeach; ?> 