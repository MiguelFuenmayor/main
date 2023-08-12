<ul class="main-menu__menu-categorias">
    <?php $menu_categorias=obtener_categorias(false,true); ?>
    <?php foreach($menu_categorias as $key => $categoria):
        $key++;?>
        <li class="menu-categorias__li"><a href="index?category=<?=$key?>"><?=$categoria?></a></li>
    <?php endforeach;?>
</ul>