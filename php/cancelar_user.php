<?php
include('../php/conexion.php');
$valorId = $conn->real_escape_string($_POST["valorId"]);
#include('../php/superAdmin.php');

$usuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $valorId"));
$User = $usuario['user_name'].'_';

$sql= "UPDATE users SET user_name = '$User', tipo = 'Cancelado' WHERE user_id = '$valorId'";

if(mysqli_query($conn, $sql)){
    echo '<script>M.toast({html:"Usuario Cancelado.", classes: "rounded"})</script>';
    ?>
    <script>
      var a = document.createElement("a");
      a.href = "../views/usuarios.php";
      a.click();   
    </script>
    <?php
}else{
    echo '<script>M.toast({html:"Ocurrio un error.", classes: "rounded"})</script>';
}
?>