<?php 
#LLAMAMOS LA SESSION CON LOS DATOS DEL USUARIO LOGEADO
session_start();
#INCLUIMOS EL ARCHIVO QUE CONTIENEN LA CONEXION A LA BASE DE DATOS
include('../php/conexion.php');
#usamos la API para encriptar la contraseña con el archivo: password_compatibility_library.php
include_once("password_compatibility_library.php");

#RECIBIMOS LAS VARIABLES POR METODO POST DEL ARCHIVO editar_user.php DEL MODAL PARA EDITAR PASSWORD
$user_id = $conn->real_escape_string($_POST['valorId']);
$Clave = $conn->real_escape_string($_POST['valorClave']);
$Contra = $conn->real_escape_string($_POST['valorContra']);

$caracteres_malos = array("<",">","\"","'","/","<",">","'","/",";","?","php","echo","{","}","=");
$caracteres_buenos = array("","","","","","","","","","","","","","","","");
      
// Eliminamos cualquier tipo de código HTML, PHP o JavaScript
$Key = str_replace($caracteres_malos, $caracteres_buenos, $Clave);
$Password = str_replace($caracteres_malos, $caracteres_buenos, $Contra);

$id = $_SESSION['user_id'];//Id del usuario logeado guardado en session_start()
$Rol = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id"));
#VERIFICAMOS SI EL USUARIO LOGEADO ES SUPER ADMIN
if($Rol['tipo'] != "Super Admin"){
  #Si es diferente de 'Super Admin' mostramos msj de alerta y no se realiza otra accion
  echo "<script >M.toast({html: 'Solo un administrador puede editar un servidor.', classes: 'rounded'});</script>";
}else{
  #SI ES SUPER ADMIN CONSULTAMOS AL USUARIO A EDITAR
  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'"));
  #VERIFICAMOS LA CONTRSEÑA ANTERIOR DEL USUARIO CON LA INGRESADA
  if (password_verify($Key, $user['user_password'])) {
    #SI LAS CONTRASEÑAS SON IGUALES PROCEDEMOS A ACTUALIZAR LA NUEVA CONTRASEÑA
    // Se encripta el la contraseña del usuario con la función password_hash(), y retorna una cadena de 60 caracteres
    $UserPassword_hash = password_hash($Password, PASSWORD_DEFAULT);
    $sql_upPass = "UPDATE users SET user_password = '$UserPassword_hash' WHERE user_id = '$user_id'";
    #SE VERIFICA SE SE EJECUTA LA SENTENCIA SQL
    if (mysqli_query($conn, $sql_upPass)) {
      #SI SE EJECUTA LA ACTUALIZACION SE REDIRECCIONA A LISTA DE USUARIOS con script
      echo '<script>M.toast({html:"El usuario se actualizó correctamente.", classes: "rounded"})</script>';
      ?>
      <script>
        var a = document.createElement("a");
        a.href = "../views/usuarios.php";
        a.click();   
      </script>
      <?php
    }else{
      #Si no se ejecuta la sentencia de actualizacion mostrar msj de error
      echo '<script>M.toast({html:"Ha ocurrido un error.", classes: "rounded"})</script>';
    }
  }else{
    #Si las contraseñas, la del usuario y la ingresada no son iguales mostrar msj de alerta
     echo '<script>M.toast({html:"Contraseña incorrecta, intentar nuevamente.", classes: "rounded"})</script>';
  }   
}
?>