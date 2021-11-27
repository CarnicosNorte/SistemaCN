<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style rel="stylesheet">
		form i {
		    margin-left: -30px;
		    cursor: pointer;
		}
	</style>
	<title>Carnicos Norte | Editar Usuario</title>
	<?php
	#INCLUIMOS EL ARCHIVO QUE TIENE LA BARRA DE NAVEGACION ASI COMO TODOS LOS ARCHIVOS DE DISEÑOS INCLUIDOS
	include('Nav.php')
	?>
	<script>
		//FUNCION QUE ENVIA LOS DATOS (POST) PARA CAMBIAR LA CONTRASEÑA (se activa en el modal)
		function update_password(id){
		  var textoClave = $("input#clave").val();
		  var textoContra = $("input#password").val();
		  var textoRepiteContra = $("input#repite_contra").val();

		  if(textoContra == ""){
	        M.toast({html:"Por favor ingrese una contraseña.", classes: "rounded"});
	      }else if ((textoContra.length) < 6) {
	        M.toast({html:"Por favor ingrese una contraseña mas larga.", classes: "rounded"});
	      }else if(textoContra != textoRepiteContra){
	        M.toast({html:"Las contraseñas no coinciden.", classes: "rounded"});
	      }else{
	      	$.post("../php/update_password.php", {
	            valorId: id,
	            valorClave: textoClave,
	            valorContra: textoContra
	         }, function(mensaje) {
	            $("#usuariosR").html(mensaje);
	         });
	      }
		}
		//FUNCION QUE CHECA SI EL email ES VALIDO (Se activa en la funcion update_usuario)
		function validar_email(email) {
      	  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      	  return regex.test(email) ? true : false;
    	};
    	//FUNCION QUE ENVIA LOS DATOS (POST) PARA EDITAR LA INFORMACION DEL USUARIO (Se activa con el boton Guardar)
	    function update_usuario(id) { 
	      var textoNombre = $("input#nombre").val();
	      var textoApellidos = $("input#apellidos").val();
	      var textoEmail = $("input#email").val();
	      var textoUsuario = $("input#usuario").val();
	      var textoRol = $("select#rol").val();
	    
	      if (textoNombre == "") {
	        M.toast({html:"Por favor ingrese el nombre(s).", classes: "rounded"});
	      }else if(textoApellidos == ""){
	        M.toast({html:"Por favor ingrese los apellidos.", classes: "rounded"});
	      }else if(textoEmail == ""){
	        M.toast({html:"Por favor ingrese un Email.", classes: "rounded"});
	      }else if (!validar_email(textoEmail)) {
	        M.toast({html:"Por favor ingrese un Email correcto.", classes: "rounded"});
	      }else if(textoUsuario == ""){
	        M.toast({html:"Por favor ingrese el nombre de usuario.", classes: "rounded"});
	      }else if(textoRol == 0){
	        M.toast({html:"Seleccione un rol de usuario.", classes: "rounded"});
	      }else{
	        $.post("../php/update_user.php", {
	        	valorId: id,
	            valorNombre: textoNombre,
	            valorApellidos: textoApellidos,
	            valorEmail: textoEmail,
	            valorUsuario: textoUsuario,
	            valorRol: textoRol
	         }, function(mensaje) {
	            $("#usuariosR").html(mensaje);
	         }); 
	      }
	    };
	</script>
</head>
<?php
#INCLUIMOS EL ARCHIVO QUE CONTIENE LA INFORMACION Y CONEXION A LA BASE DE DATOS
include('../php/conexion.php');
#Verificar si se recibe la variable user_id con el metodo POST de la lista usuarios.php
if (isset($_POST['user_id']) == false) {
	#Si es igual a false mostramos msj de advertencia y redirecionamos a la lista de usuarios.php
	?>
	<script>
		function atras(){
			M.toast({html: "Regresando al listado...", classes: "rounded"});
			setTimeout("location.href = 'usuarios.php'", 1000);
		}
		atras();
	</script>
	<?php
}else{
#Si es True recibimos la variable user_id y mostramos el contenido de body
$user_id = $_POST['user_id'];
#Seleccionamos la informacion del usuario
$usuario = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id"));
?>
<body>
	<div class="container">
		<div class="row" id="usuariosR">
			<h2>Editar Usuario:</h2>
			<div class="row">
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="nombre" value="<?php echo $usuario['firstname']; ?>">
		        <label for="nombre">Nombre</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="apellidos" value="<?php echo $usuario['lastname']; ?>">
		        <label for="apellidos">Apellidos</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="email" class="validate" required id="email" value="<?php echo $usuario['user_email']; ?>">
		        <label for="email">E-mail</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="usuario" value="<?php echo $usuario['user_name']; ?>">
		        <label for="usuario">Nombre de usuario</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		          <select id="rol" class="browser-default">
		            <option value="<?php echo $usuario['tipo']; ?>" selected><?php echo $usuario['tipo']; ?></option>
		            <option value="Super Admin">Super Admin</option>
		            <option value="Administrador">Administrador</option>
		            <option value="Operativo">Operativo</option>
		            <option value="Oficina">Oficina</option>
		          </select>
		      </div>
		      <div class="input-field col s12 m3 l3">
		        <a href="#selPassword" class="waves-effect waves-light btn amber black-text modal-trigger"><i class="material-icons right">edit</i><b>Contraseña</b></a>
		      </div>
		      <div class="input-field col s12 m3 l3">
		        <a onclick="update_usuario(<?php echo $user_id; ?>);" class="waves-effect waves-light btn right amber black-text"><i class="material-icons right">send</i><b>Guardar</b></a>
		      </div>
    		</div>
		</div>
	</div>
	<!--Modal cortes-->
	<div id="selPassword" class="modal">
	  <div class="modal-content">
	    <h4 class="red-text center">! Advertencia !</h4>
	    <h6 ><b>Una vez aceptado, los cambios seran definitivos. </b></h6>
	    <h5 class="red-text darken-2">¿DESEA CONTINUAR?</h5>
	    <div class="row">
		    <div class="input-field col s12 m6 l6">
		        <i class="material-icons prefix">lock_outline</i>
		        <input type="password" name="clave" id="clave">
		        <label for="clave">Contraseña Anterior</label>
		    </div>
	    </div>
	    <form class="row">
	      <div class="input-field col s10 m5 l5">
		    <i class="material-icons prefix">lock</i>
		    <input type="password" class="validate" value="123" name="password" id="password">
		    <label for="contra">Nueva Contraseña</label>
          	<i class="bi bi-eye-slash prefix" id="togglePassword"></i>
		  </div>
		  <div class="col s1"><br></div>
		  <div class="input-field col s12 m6 l6">
		    <i class="material-icons prefix">lock</i>
		   	<input type="password" class="validate" required id="repite_contra">
		    <label for="repite_contra">Repetir Contraseña</label>
		  </div>
	    </form>
	  </div>
	  <div class="modal-footer">
	      <a onclick="update_password(<?php echo $user_id; ?>)" class="modal-action modal-close waves-effect waves-green green btn-flat">Cambiar<i class="material-icons right">done</i></a>
	      <a href="#" class="modal-action modal-close waves-effect waves-red amber btn-flat">Cerrar<i class="material-icons right">close</i></a>
	  </div>
	</div>
	<!--Cierre modal Cortes-->
	<script>
		const togglePassword = document.querySelector('#togglePassword');
		const password = document.querySelector('#password');
		togglePassword.addEventListener('click', function (e) {
		    // toggle the type attribute
		    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
		    password.setAttribute('type', type);
		    // toggle the eye / eye slash icon
		    this.classList.toggle('bi-eye');
		});
	</script>
</body>
<?php
}
?>
</html>