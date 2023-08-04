<?php if(!empty($_GET['main'])) : 
$get=$_GET['main'];
$main=obtener_entradas($get);
   $main=$main[0];
 $autor=obtener_autor($main[2]);
 $categorias=obtener_categorias($main[1]);  ?>

<div id="main"> 
    <h2><?=$main[3]?></h2>
    <img width="600px" src="<?=$main[5]?>" alt="img">
    <h6 id="info-main"><?=$autor?> - <?=$main[6]?> - <?=$categorias?></h6>
    <p><?=$main[4]?></p>
</div>
<?php endif;?>