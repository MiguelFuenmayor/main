<?php
!empty($_SESSION['user']) ? $entradas=obtener_entradas(false,false,false,false,$_SESSION['user']['id']) : $entradas='No tienes entradas aún';
if(is_array($entradas)) :
 foreach($entradas as $entrada) :  
 $autor=obtener_autor($entrada[2]);
 $categorias=obtener_categorias($entrada[1]);  ?>

<div class="lista-main" style="background-image:url('<?=$entrada[5]?>') ;">

    
<a href="index?main=<?=$entrada[0]?>">
    <h6 class="info-preview"><?=$autor?> - <?=$entrada[6]?> - <?=$categorias?></h6>
    <h3 class="preview-title"><?=$entrada[3]?></h3>
    
    </a>
    
</div>

<?php endforeach;
elseif(is_string($entradas)): ?>
<p><?=$entradas?></p>
<?php endif;
?>