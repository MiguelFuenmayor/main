<?php
$connection= mysqli_connect('localhost','root','','blog');
/* Se necesitan las siguientes funciones
1. Lista de las ultimas publicaciones 7
2. Lista de todas las publicaciones  7
3. Selección de la entrada seleccionada a partir del id. 7
4. buscador 7
5. crear entrada (realizar el insert a partir de los datos de un form) 7
6. Funcion de login (Con errores) 7
7. funcion de registrarse (Con errores) 7
8. generador visual de la entrada
Además, debemos integrar las imagenes a partir de php/html (ya se pueden abrir las fotos)
*/

function obtener_entradas($id=false,$limit=false,$busqueda=false,$categoria=false){
    GLOBAL $connection;
    if($connection){
        $query="SELECT * FROM entradas";

        if($busqueda!==false && is_string($busqueda) && $categoria==false){  //BUSQUEDA POR TITULO
            $query.=" WHERE titulo LIKE '%$busqueda%'";
        }

        if($id==false && $busqueda==false && is_string($categoria)){ //BUSQUEDA POR CATEGORIA   
            $query.=" WHERE categorias LIKE '%$categoria%' ";
        }

        if($id!==false && $limit==false && $categoria==false){  //BUSQUEDA POR ID
            $query.=" WHERE id=$id";
        }
        
        if($limit!==false && $id==false && $categoria==false){  //APLICACION DE LIMITE
            $query.=" LIMIT $limit";
        }
        
        $result=mysqli_query($connection,$query);
        
    }else{$result=false;}
    if($result){
        $result=mysqli_fetch_all($result);
    }
    return $result;
}


/*LA FUNCION PUEDE REGRESAR LOS SIGUIENTES VALORES:
$registro con mensajes de error : string
$registro con true para el registro : boolean
$registro con array cuando hay un login exitoso : array, 7 indices
$errores con array de errores durante la validación en el registro: array, 3 indices

EN CASO DE QUE SE NECESITE SEPARARLAS POR PRACTICIDAD, ES IMPORTANTE DEJAR EL VERIFY DE CONECCION EN AMBOS
Y AQUELLAS PARTES QUE COMPARTEN. EL RESTO DEL CODIGO FUNCIONA BIEN INCLUSO POR SEPARADO
**/ 

function registro_login($mail,$contrasena,$nombre=false){ //Esta funcion deberia funcionar para ambos casos
    GLOBAL $connection;
    $errores=false;
    if($connection){ 
        if($nombre!==false){$nombre=trim($nombre);}

        $mail=trim($mail);
        $mail= settype($mail,'string');
        $contrasena=settype($contrasena,'string');
        $contrasena=trim($contrasena);
        
        //SE VERIFICA LA CONEXION
        $mail_verify="SELECT mail FROM usuarios WHERE mail=$mail"; //QUERY==VERIFICACION DE EMAIL
        $mail_verify=mysqli_query($connection,$mail_verify);
        $mail_verify=mysqli_num_rows($mail_verify);

        //ESTAS VALIDACIONES LAS COLOCO AQUI PARA USARLAS DOS VECES AB-
        $mail_var=filter_var($mail,FILTER_VALIDATE_EMAIL);
        $contrasena_var = (strlen($contrasena)>8 && strlen($contrasena)<16) 
        ? preg_match("/[a-zA-Z0-9._-]/",$contrasena) : false;
            //AQUI SE ESTÁ EJECUTANDO UN REGISTRO
        if($mail_verify==0 && $nombre!==false){ //REGISTRO IDENTIFICADO POR LA INT DE NOMBRE Y EMAIL NO DETECTADO
               //AB- ORIGINALMENTE IBA AQUI
                $nombre_var=preg_match("/[a-zA-Z ]/",$nombre);
            if( $mail_var //VALIDACION
            && $contrasena_var //VALIDACION
            && $nombre_var){
                $contrasena=password_hash($contrasena,PASSWORD_DEFAULT);
                //VALIDACION
            $query="INSERT INTO usuarios VALUES(NULL,$nombre,$mail,$contrasena,CURDATE())"; //query de registro
            $query=mysqli_query($connection,$query); //ejecución query
            $registro = ($query==true) ? "registro completado!" : "registro invalido;("; //resultados de la query
            }else{
                //ARRAY DE ERRORES
                $errores=array();
                $errores[] = ($mail_var==false) ? "mail invalido" : "";
                $errores[] = ($contrasena_var==false) ? "contrasena invalida" : "";
                $errores[] = ($nombre_var==false) ? "nombre invalido" : "";
                return $errores;
                }
            }elseif($mail_verify==1 && $nombre!==false){ //si se está ingresando un nombre, y el mail existe
            $registro="el mail ya está registrado!"; // este seria el mensaje
        }
        //DESDE AQUÍ SE EJECUTA UN LOGIN Y NO UN REGISTRO
        if($mail_verify==1 && $nombre==false && $mail_var && $contrasena_var){  //LOGIN IDENTIFICADO POR AUSENCIA DE NOMBRE Y MAIL DETECTADO
            $obtener_contra="SELECT contrasena FROM usuarios WHERE email==$mail";
            $hash=mysqli_query($connection,$obtener_contra);
            $verify_password=password_verify($contrasena,$hash);
            if($verify_password){
            $query="SELECT * FROM usuarios WHERE mail=$mail AND contrasena=$contrasena"; //query de login
            
            $registro=mysqli_query($connection,$query);  //ejecución query
            $registro = (mysqli_num_rows($registro)==1) //si el registro es valido regresará un array con todos los datos
                                                        //del usuario, caso contrario, delata contraseña invalida. todavia falta validacion de contraseña;
            ? mysqli_fetch_assoc($registro) : "contraseña incorrecta imposible"; //resultados; este error deberia ser imposible
        }else{$registro="contraseña incorrecta";}

        }elseif($mail_verify==0 && $nombre==false){$registro="mail no registrado";} //mail no registrado

    }else{$registro="La conección falló";} //si la conección falla jajaj

   return $registro;            //return de la variable '$registro' como resultado en cualquier caso
}


/* ESTA FUNCIÓN PUEDE REGRESAR DOS VALORES POSIBLES:
UN STRING SI SALE BIEN LA OPERACIÓN (EN $RESULT)
O UN ARRAY CON LOS ERRORES */
function crear_entrada($titulo,$contenido,$img,$usuario_id,$categorias){
   
    //CONECCION 
    GLOBAL $connection;
    //array entrada
    $entrada=[];
    $errores=[];
    $titulo=trim($titulo);
    $contenido=trim($contenido);
    //VALIDACION DE LOS DATOS
    if($connection){  //verificación de la conección
        if($categorias){$entrada[]=$categorias;}else{$errores[]="categoria";} //asignación de los valores y revisión
        if($usuario_id){$entrada[]=$usuario_id;}else{$errores[]="usuario_id";}
        if(strlen($titulo)<200 && preg_match("/[a-z A-Z0-9._-]/",$titulo)){$entrada[]=$titulo;}else{$errores[]="titulo";}
        if(is_string($contenido)){$entrada[]=$contenido;}else{$errores[]="contenido";}
        
        if(!empty($img) && is_dir('img_blog') ){
            $img_name=$img['name'];
            //$img_type=substr($img['type'],6);
            $img_url="img_blog/$img_name";
            move_uploaded_file($img['tmp_name'],$img_url);
            $entrada[]=$img_url;
        }else{$errores[]="imagen";}
        }
        
    if(is_array($entrada) && count($errores)==0 && count($entrada)==5 && $titulo!==false && $contenido!==false && $img_url!==false){ //last if
       
      
        //$u_id=settype($u_id,'int');
       
   
        $query="INSERT INTO entradas VALUES(NULL,'$entrada[0]','$entrada[1]','$entrada[2]','$entrada[3]','$entrada[4]',CURDATE())"; //query
        $query=mysqli_query($connection,$query); //ejecución de la query
        $result = ($query==true) ? "Entrada creada correctamente" : "La entrada no se ha creado"; //resultados
        return $result; //result con el string de resultado
    }elseif(count($errores)!==0){
        return $errores; //$errores con el array de errores
    }
}

function obtener_autor($id){
    GLOBAL $connection;
    if($connection && $id){
        $query="SELECT nombre FROM usuarios WHERE id=$id";
        $nombre_autor=mysqli_query($connection,$query);
        $nombre_autor=mysqli_fetch_assoc($nombre_autor);
        $nombre_autor=join('',$nombre_autor);
    }else{$nombre_autor=false;}
    return $nombre_autor;
}

//conseguir nombres de las categorias a partir de su id
function obtener_categorias($string,$all=false){
    GLOBAL $connection;
    if($connection && is_string($string) && $all==false){
        $query="SELECT nombre FROM categorias WHERE ";
        $categorias_id=explode(',',$string);
        
        foreach($categorias_id as $key => $categoria_id){
            $limit=(count($categorias_id)-1);
       
            $query.= ($limit!==$key) ? "id=$categoria_id OR " : "id=$categoria_id";
        }
        $categorias=mysqli_query($connection,$query);    
           
            while($row=mysqli_fetch_array($categorias)){
                $nombre=$row[0];
                $result[]=$nombre;
            }
           
        $result=join(', ',$result);
        
        
    }elseif($all==true){
        $query="SELECT nombre FROM categorias";
        $categorias=mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($categorias)){
            $nombre=$row[0];
            $result[]=$nombre;
            
        }
    }

    return $result;
}