<?php
require_once('views/head.php');
require_once('back/upload_entrada.php');
require_once('views/Menu.php');
require_once('views/lateral.php'); ?>
<?php

if(!empty($_SESSION['resultado'])){   //se reciben errores
    $resultado=$_SESSION['resultado'];
    session_abort();

}
if(!empty($_GET['resultado'])){  //se recibe resultado de la función
    $resultado=$_GET['resultado'];
}

?>
<div id='contenido'> 
    <h2>Crear entrada</h2> 
            <?php if(!empty($resultado) && is_array($resultado)) :  //se listan errores
                foreach($resultado as $error): ?>
                     <div id="error">
                        <p>error en <?=$error?></p>
                     </div>
                     <br/>
            <?php endforeach;
                elseif(!empty($resultado) && is_string($resultado)): //se muestra resultado de la función?> 
                    <div id="msg">
                        <p><?=$resultado?></p>
                    </div>
                <?php endif; ?>

      <?php require_once('views/form_crear_entrada.php'); ?> <!--FORMULARIO-->
</div><!-- FIN CONTENIDO -->


<?php require_once('views/pie.php'); ?>