<?php
#Iniciamos la session con los datos guardados del usuario logeado
session_start();
#INCLUIMOS EL ARCHIVO CON LA INFORMACION PARA HACER CONEXION A LA BASE DE DATOS
include('../php/conexion.php');
#INCLUIMOS UN ARCHIVO EL CUAL SOLO DEJARA AVANZAR SI EL USUARIO ES SUPER ADMIN.
include('../php/superAdmin.php');
#Recibimos la variable valorId con el metodod POST de listado usuarios.php al precionar el boton cancelar
$valorId = $conn->real_escape_string($_POST["valorId"]);
#Seleccionamos la informacion del usuario con la variable recibida
$usuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $valorId"));
$user_name = $usuario['user_name'].'_';//Se crea una variable con un nuevo nombre de usuario
#CREAMOS LA SENTENCIA PARA ACTUALIZAR EL NOMBRE DE USUARIO Y EL TIPO A 'Cancelado'
$sql= "UPDATE users SET user_name = '$user_name', tipo = 'Cancelado' WHERE user_id = '$valorId'";
#VERIFICAMOS SI LA SENTENCIA FUE EJECUTADA Y SE REALIZA LA ACTUALIZACION DEL USUARIO
if(mysqli_query($conn, $sql)){
	#Si se ejecuta la sentencia mstramos msj y redireccionamos con script a la lista de usuarios
    echo '<script>M.toast({html:"Usuario Cancelado.", classes: "rounded"})</script>';
    ?>
    <script>
      var a = document.createElement("a");
      a.href = "../views/usuarios.php";
      a.click();   
    </script>
    <?php
}else{
	#Si no se ejecuta la sentencia mostramos msj de error
    echo '<script>M.toast({html:"Ocurrio un error.", classes: "rounded"})</script>';
}
?>