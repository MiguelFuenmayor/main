<div id='menu'>
        <ul>
        <a href="index.php"><li>Inicio</li></a>
            <li>Categorias</li>
                <?php require_once('menu_categorias.php');?>
            <a href="crear_entrada.php"><li>Crear una entrada</li></a>
        </ul>    
        <div id='buscador'>
            <form method="POST">
                <input type="text" name="search" placeholder="..."/>
                <input type="submit" value="Buscar"/>
            </form>
        </div> <!--Fin buscador-->
    </div> <!--FIN MENU-->