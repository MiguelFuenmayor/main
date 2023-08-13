
<?php 
if(!empty($_POST['search']))
{$entradas=(empty($_POST['search'])) ? obtener_entradas() : obtener_entradas(false,false,$_POST['search']);
unset($_POST['search']);
}elseif(!empty($_GET['category']))
{$entradas=(empty($_GET['category'])) ? obtener_entradas() : obtener_entradas(false,false,false,$_GET['category']);
unset($_GET['category']);}else{
    $entradas=obtener_entradas(false,'6');


}

if(is_array($entradas)) :
 foreach($entradas as $entrada) :  
 $autor=obtener_autor($entrada[2]);
 $categorias=obtener_categorias($entrada[1]);  ?>

<div class="lateral__preview" 
style="background-image:url('<?=$entrada[5]?>') ;">

    
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