<?php if(!empty($_GET['main'])) : 
$get=$_GET['main'];
$main=obtener_entradas($get);
   $main=$main[0];
 $autor=obtener_autor($main[2]);
 $categorias=obtener_categorias($main[1]);  ?>

<div class="grid-contenido__main"> 
    <h2 class="main-title"><?=$main[3]?></h2>
    <img class="main-img" width="600px" src="<?=$main[5]?>" alt="img">
    <?php if(!empty($_SESSION['user'])) : 
    if($main[2]==$_SESSION['user']['id']): ?>
      <a href="editar_entrada.php?id=<?=$main[0];?>"><p>Editar</p></a>
    
    <?Php endif; 
    endif ?>
    <h6 class="main-info"><?=$autor?> - <?=$main[6]?> - <?=$categorias?></h6>
    <p class="main-desc"><?=$main[4]?></p>
</div>
<?php endif;?>