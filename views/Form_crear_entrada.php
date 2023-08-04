<form action="../back/upload_entrada.php" method="post" enctype="multipart/form-data"> <!--INICIO FORMULARIO-->
    <input type="text" required="required" 
        name="titulo" pattern="/[a-z A-Z0-9._-]+/" 
        minlength="10" maxlength="200" placeholder="Ingrese el titulo..."/> <br/> <!--SUBIDA DE TITULO-->
    <textarea name="contenido" pattern="/[a-z A-Z0-9._-]+/"
    placeholder="Ingrese el contenido..." required="required"></textarea><br/> <!--SUBIDA DE CONTENIDO-->
    <input type="file" name="imagen"/><br/>  <!--SUBIDA DE IMAGEN-->
    <div> <!--SELECCION DE CATEGORIAS-->
        <label>Selecciona las categorias</label>
        <?php $menu_categorias=obtener_categorias(false,true); ?>
        <?php foreach($menu_categorias as $key => $categoria):
        $key++;?>
            <input type="checkbox" name="categorias[]" value="<?=$key?>"/>
            <label><?=$categoria?></label>
        <?php endforeach;?>
    </div> <!--FIN SELECCIÓN CATEGORIAS-->
    <input type="submit" value="Crear"/> <!--MANDAR DATOS A LA FUNCIÓN DE CREAR-->
</form> <!--FIN FORMULARIO-->