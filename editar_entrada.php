<?Php
    require_once ('views/head.php');
    require_once('views/Menu.php');
    require_once('views/lateral.php');
    require_once('back/editar_eliminar_entrada.php');
//contenido
    if(!empty($_SESSION['user'])):
        if($_SESSION['user']['id']==$_GET['autor-id']):
            $entrada=obtener_entradas($_GET['id']);
            $entrada=$entrada['0'];
            if(!empty($result) && is_array($result)):       
              foreach($result as $error):?>
                <div class="error">
                    <p>error en <?=$error?></p>
                </div>
                <?Php endforeach;
            elseif(!empty($result) && is_string($result)):?>     
                <div>
                    <p><?=$result?></p>
                </div>

  <?php          endif; ?>
<!--FORM PARA EDITAR-->
        
            <form method="post" enctype="multipart/form-data">
                <input type="text" pattern="/[a-z A-Z0-9._-]+/" required="required" placeholder="Ingrese el titulo..." value="<?=$entrada['3']?>" name="titulo" pattern="[A-Z a-z0-9.-_]+">
                <textarea  required="required" placeholder="Ingrese el contenido..." name="desc"><?=$entrada['4']?></textarea>
                <input type="file" name="img_url">
                <div> <!--SELECCION DE CATEGORIAS-->
                    <label>Selecciona las categorias</label>
                    <?php $menu_categorias=obtener_categorias(false,true); ?>
                    <?php foreach($menu_categorias as $key => $categoria):
                    $key++;?>
                    <input type="checkbox" name="categorias[]" value="<?=$key?>"/>
                    <label><?=$categoria?></label>
                    <?php endforeach;?>
                </div>
                <input type="text" hidden="hidden" name="user_id" value="<?=$entrada['2']?>"> 
                <input type="text" hidden="hidden" name="id" value="<?=$entrada['0']?>"> 
                <!--FIN SELECCIÓN CATEGORIAS-->
                <input type="submit" name="accion" value="Editar">
            </form>
            <form> <!--FORM PARA ELIMINAR-->
            <input type="text" hidden="hidden" name="user_id" value="<?=$entrada['2']?>"> 
                <input type="text" hidden="hidden" name="id" value="<?=$entrada['0']?>"> 
                    <input type="submit" name="accion" value="eliminar">
                    
            </form>
<?php
        endif;

    endif;

require_once('views/pie.php');


?>