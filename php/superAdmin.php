<?php 
$id = $_SESSION['user_id'];//SELECCIONAMOS EL ID DEL USUARIO LOGEADO GUARDADO EN LA SESSION
#SELECCIONAMOS LA INFORMACION DEL USUARIO LOGEADO segun el id de la session
$user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id=$id"));
#VERIFICAMOS SI EL USUARIO LOGEADO ES SUPER ADMIN.
if($user['tipo']=="Super Admin"){
	#Si el usuario es 'Super Admin' no se realiza ninguna accion extra
}else{
	#Si el usuario no es 'Super Admin' mostrar msj de alerta y redirecionar a home.php con script
	echo '<script>M.toast({html:"Permiso denegado. Direccionando a la página principal.", classes: "rounded"})</script>';
  	?><script>setTimeout("location.href='home.php'", 1000);</script><?php
  	#Cerramos la conexion a la base de datos.
	mysqli_close($conn);
	exit;
}
?>