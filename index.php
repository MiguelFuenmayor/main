<!DOCTYPE html>
<html>
<head>
    <?php $connection= mysqli_connect('localhost','root','','blog');
    require_once('funciones.php'); ?>
    <link rel="stylesheet" href="styles.css"/>
    <title>Poringa</title>
    <meta charset='utf-8'/>
</head>
<body>
    <header>
   <h1> BIENVENIDO</h1>
    </header> <!-- FIN HEADER -->

    <div id='menu'>
        <ul>
            <li>Inicio</li>
            <li>Categorias</li>
            <li>Crear una entrada</li>
            <li>sobre mi</li>
            <li>Contacto</li>
</ul>    
        <div id='buscador'>
            <form>
                <input type="text" placeholder="..."/>
                <input type="submit" value="Buscar"/>
            </form>
        </div> <!--Fin buscador-->
    </div> <!--FIN MENU-->
    <aside id='lateral'>
        <h2>LATERAL</h2>
        <!--AQUI IRÁ EL DISPLAY DE UNA CONSULTA-->
    </aside> <!-- FIN LATERAL -->

    <div id='contenido'> 
        <h2>CONTENIDO</h2> 
        <?php 
        
        ?>
    </div>    <!-- FIN CONTENIDO -->
    
    <footer id='pie'>
       <h2>FOOTER</h2>
    </footer> <!-- FIN PIE -->
</body>
</html>