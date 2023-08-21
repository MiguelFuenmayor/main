<?php 
require_once('views/head.php');
if(!empty($_GET['login'])){
    $error_login=$_GET['login'];
    unset($_GET['login']);  //error login
}elseif(!empty($_GET['registro'])){ //registro exitoso
    $exito_registro=$_GET['registro'];
    unset($_GET['registro']);
}elseif(!empty($_SESSION['error'])){ //error registro
    $errores=$_SESSION['error']; //DEBES TERMINAR DE RECIBIR TODOS LOS RESULTADOS DE login_registro.php
    unset($_SESSION['errores']);
}elseif(!empty($_SESSION['user'])       ){ //exito login
    header('refresh:1;index.php');
}
require_once('views/Menu.php');
require_once('views/lateral.php'); ?>
<div id='contenido'> 
    

        <?php 
            if(!empty($_GET['crear']) && $_GET['crear']==1):?>
                <div>
                    <p>Para crear una entrada primero debes iniciar sesión</p>
                </div>
            <?php unset($_GET['crear']); 
        endif; ?>  
            <?Php      
            if(!empty($error_login)): ?>
            <div>
                <p><?=$error_login?></p>
            </div>
        <?php elseif (!empty($exito_registro)): ?>
            <div>
                <p><?=$exito_registro?></p>
            </div>
        <?php endif; ?> 
        <div>
            <?php
                if(!empty($_GET['accion']) && $_GET['accion']==1 && empty($_SESSION['user'])){ require_once('views/login.php');
                }elseif(!empty($_GET['accion']) && $_GET['accion']==2 && empty($_SESSION['user'])){require_once('views/registrarse.php');} 
            ?>        
        </div>
        <?php if(!empty($_SESSION['user'])):?>
                <div> <!--INFO DEL USUARIO-->
                    <h2><?=$_SESSION['user']['nombre']?></h2>
                    <h3><?=$_SESSION['user']['mail']?></h3>
                    <h6><?=$_SESSION['user']['fecha']?></h6>
                </div>
                <!--ENTRADAS DEL USUARIo-->
                <?php require_once('views/Entradas_main.php'); ?>
        <?php endif; ?>

    </div>    <!-- FIN CONTENIDO -->
<?php  
require_once('views/pie.php'); ?>