<?php 
#INCLUIMOS EL ARCHIVO QUE CONTIENEN LA CONEXION A LA BASE DE DATOS
include('../php/conexion.php');
#usamos la API para encriptar la contraseña con el archivo: password_api_compatibility_library.php
include_once("password_compatibility_library.php");

#RECIBIMOS LAS VARIABLES POR METODO POST DEL ARCHIVO form_usuario.php DEL FORMULARIO PARA NUEVO USUARIO
$Nombre = $conn->real_escape_string($_POST['valorNombre']);
$Apellidos = $conn->real_escape_string($_POST['valorApellidos']);
$Email = $conn->real_escape_string($_POST['valorEmail']);
$Usuario = $conn->real_escape_string($_POST['valorUsuario']);
$Contra = $conn->real_escape_string($_POST['valorContra']);
$Rol = $conn->real_escape_string($_POST['valorRol']);
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/",";","?", "php", "echo","$","{","}","=");
$caracteres_buenos = array("", "", "", "", "", "", "", "", "","","", "","","", "","","");
      
// Eliminamos cualquier tipo de código HTML, PHP o JavaScript
$FirstName = str_replace($caracteres_malos, $caracteres_buenos, $Nombre);
$LastName = str_replace($caracteres_malos, $caracteres_buenos, $Apellidos);
$UserName = str_replace($caracteres_malos, $caracteres_buenos, $Usuario);
$UserEmail = str_replace($caracteres_malos, $caracteres_buenos, $Email);           
$UserPassword = str_replace($caracteres_malos, $caracteres_buenos, $Contra);
$UserRol = str_replace($caracteres_malos, $caracteres_buenos, $Rol);

$date_added=date("Y-m-d H:i:s");
// Se encripta el la contraseña del usuario con la función password_hash(), y retorna una cadena de 60 caracteres
$UserPassword_hash = password_hash($UserPassword, PASSWORD_DEFAULT);

#VERIFICAMOS SI NO HAY UN USUARIO CON EL MISMO NOMBRE O CORREO
if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE user_name='$UserName' OR user_email = 'UserEmail'"))>0){
  echo '<script>M.toast({html:"Este usuario o correo ya existe en la base de datos.", classes: "rounded"})</script>';
}else{
    //o $consultaBusqueda sea igual a nombre + (espacio) + apellido
    $sql = "INSERT INTO users (firstname, lastname, user_name, user_password, user_email, date_added, tipo)  VALUES('$FirstName', '$LastName', '$UserName', '$UserPassword_hash', '$UserEmail', '$date_added', '$UserRol')";
    if(mysqli_query($conn, $sql)){
    	echo '<script>M.toast({html:"Usuario añadido correctamente.", classes: "rounded"})</script>';
        ?>
          <script>    
              setTimeout("location.href='../views/usuarios.php'", 800);
          </script>
        <?php
    }else{
    	echo '<script>M.toast({html :"Ha ocurrido un error.", classes: "rounded"})</script>';	
    }
}
?>