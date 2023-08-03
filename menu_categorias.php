<ul>
    <?php $menu_categorias=obtener_categorias(false,true); ?>
    <?php foreach($menu_categorias as $key => $categoria):
        $key++;?>
        <a href="index?category=<?=$key?>"><li><?=$categoria?></li></a>
    <?php endforeach;?>
</ul>