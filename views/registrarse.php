<?php 
    if(!empty($errores)):
        foreach($errores as $error): ?>
            <div class="registro__error">
                <?= $error?>
            </div>
<?php   endforeach; 
    endif; ?>
<form method="POST" action="">
    <input type="text" name="nombre" pattern="([a-zA-Z]+)(\s[a-zA-Z]+)?" placeholder="Inserte su nombre"> 
    <input placeholder="Ingrese su email" type="mail" name="mail">
    <input placeholder="Ingrese su contraseña" 
    type="password" name="contrasena" pattern="/[a-z A-Z0-9._-]+/" minlength="8" maxlength="16">
    <input type="submit" value="Registrarme">
</form>