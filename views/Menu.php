<div class="grid-item main-menu">
        <ul class="main-menu__list">
        <li class="main-menu__list-item">
            <a href="index.php">
                Inicio
            </a>
        </li>
            <li class="main-menu__list-category main-menu__list-item">
                Categorias
            </li>
                <?php require_once('views/menu_categorias.php');?>
            <li class="main-menu__list-item"><a href="crear_entrada.php">Crear una entrada</a></li>
        </ul>    
        <div class="main-menu__buscador">  <!--BUSCADOR-->
            <form method="POST" action="index.php">
                <input type="text" class="buscador__input" name="search" placeholder="Inserte su busqueda"/>
                <input type="submit" class="buscador__submit" value="Buscar"/>
            </form>
        </div> <!--Fin buscador-->
    </div> <!--FIN MENU-->