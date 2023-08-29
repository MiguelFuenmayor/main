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
if(!empty($_POST['nombre']) OR !empty($_POST['mail']) OR !empty($_POST['pass1']) OR !empty($_POST['pass2'])){
    $edicion=editar_usuario($_SESSION['user']['id'],$_POST['nombre'],$_POST['mail'],$_POST['pass1'],$_POST['pass2']);
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
                    <a href="User.php?editar=editar"><h6>Editar datos del usuario</h6></a>
                </div>
                <?php if($_GET['editar']="editar"): 
                    $usuario=obtener_autor($_SESSION['user']['id'],true)?>
                <div> <!--editar info del usuario-->
                    <?Php if(!empty($edicion)): 
                        foreach($edicion as $result):?>
                            <div>
                                <?=$result?>
                            </div>                            
                        <?php endforeach;
                     endif; ?>
                    <form action="User.php?editar=editar" method="POST">
                        <input type="text" name="nombre" value="<?=$usuario['nombre']?>">
                        <input type="text" name="email" value="<?=$usuario['mail']?>">
                        <input type="password" name="pass1">
                        <input type="password" name="pass2">
                        <input type="submit" value="Editar">
                    </form>
                </div>
                <?php endif; ?>
                <!--ENTRADAS DEL USUARIo-->
                <?php require_once('views/Entradas_main.php'); ?>
        <?php endif; ?>

    </div>    <!-- FIN CONTENIDO -->
<?php  
require_once('views/pie.php'); ?>