<?php	
	#SE LLAMA LA SESSION DEL USUARIO LOGEADO Y TODA SU INFORMACION GUARDADA
	session_start();
	#VERIFICAMOS QUE HAYA UNA SESSION CREADA Y QUE CONTENGA EL status = 1 QUE VERIFICA QUE HAY UN USUARIO LOGEADO
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
		#Si el status es diferente != a 1 redireccionamos a el formulario de login
        header("location: ../views/login.php");
		exit;
    }
?>