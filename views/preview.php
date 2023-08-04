
<?php 
if(!empty($_POST['search']))
{$entradas=(empty($_POST['search'])) ? obtener_entradas() : obtener_entradas(false,false,$_POST['search']);
unset($_POST['search']);
}elseif(!empty($_GET['category']))
{$entradas=(empty($_GET['category'])) ? obtener_entradas() : obtener_entradas(false,false,false,$_GET['category']);
unset($_GET['category']);}else{
    $entradas=obtener_entradas();
}

if(is_array($entradas)) :
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

<?php endforeach;
elseif(is_string($entradas)): ?>
<p><?=$entradas?></p>
<?php endif;
?>