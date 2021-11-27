<?php 
session_start();
#INCLUIMOS EL ARCHIVO QUE CONTIENEN LA CONEXION A LA BASE DE DATOS
include('../php/conexion.php');

#RECIBIMOS LAS VARIABLES POR METODO POST DEL ARCHIVO editar_user.php DEL FORMULARIO PARA EDITAR USUARIO
$user_id = $conn->real_escape_string($_POST['valorId']);
$Nombre = $conn->real_escape_string($_POST['valorNombre']);
$Apellidos = $conn->real_escape_string($_POST['valorApellidos']);
$Email = $conn->real_escape_string($_POST['valorEmail']);
$Usuario = $conn->real_escape_string($_POST['valorUsuario']);
$Rol = $conn->real_escape_string($_POST['valorRol']);

$caracteres_malos = array("<",">","\"","'","/","<",">","'","/",";","?","php","echo","{","}","=");
$caracteres_buenos = array("","","","","","","","","","","","","","","","");
      
// Eliminamos cualquier tipo de código HTML, PHP o JavaScript
$FirstName = str_replace($caracteres_malos, $caracteres_buenos, $Nombre);
$LastName = str_replace($caracteres_malos, $caracteres_buenos, $Apellidos);
$UserName = str_replace($caracteres_malos, $caracteres_buenos, $Usuario);
$UserEmail = str_replace($caracteres_malos, $caracteres_buenos, $Email);      
$UserRol = str_replace($caracteres_malos, $caracteres_buenos, $Rol);

$id = $_SESSION['user_id'];//Id del usuario logeado guardado en session_start()
$Rol = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id"));

#VERIFICAMOS SI EL USUARIO LOGEADO ES SUPER ADMIN
if($Rol['tipo']!="Super Admin"){
  echo "<script >M.toast({html: 'Solo un administrador puede editar un servidor.', classes: 'rounded'});</script>";
}else{
  #SI ES SUPER ADMIN CREAMOS LA SENTENCIA DE ACTUALIZACION
  $sql= "UPDATE users SET firstname = '$FirstName', lastname = '$LastName', user_name = '$UserName', user_email = '$UserEmail', tipo = '$UserRol' WHERE user_id = '$user_id'";
  #VERIFICAMOS SI SE EJECUTA LA SENTENCIA SQL
  if (mysqli_query($conn, $sql)) {
    #SI SE EJECUTA LA ACTUALIZACION MOSTRAMOS MENSAJE Y REDIRIJIMOS CON script
    echo '<script>M.toast({html:"El usuario se actualizó correctamente.", classes: "rounded"})</script>';
    ?>
    <script>
      var a = document.createElement("a");
      a.href = "../views/usuarios.php";
      a.click();   
    </script>
    <?php
  }else{
   echo '<script>M.toast({html:"Ha ocurrido un error.", classes: "rounded"})</script>';
  }
}
?>