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
	<title>Carnicos Norte | Nuevo Usuario</title>
	<?php
	include('Nav.php')
	?>
	<script>
		function validar_email( email ) {
      	  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      	  return regex.test(email) ? true : false;
    	};
	    function insert_usuario() {
	      var textoNombre = $("input#nombre").val();
	      var textoApellidos = $("input#apellidos").val();
	      var textoEmail = $("input#email").val();
	      var textoUsuario = $("input#usuario").val();
	      var textoContra = $("input#password").val();
	      var textoRepiteContra = $("input#repite_contra").val();
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
	      }else if(textoContra == ""){
	        M.toast({html:"Por favor ingrese una contraseña.", classes: "rounded"});
	      }else if ((textoContra.length) < 6) {
	        M.toast({html:"Por favor ingrese una contraseña mas larga.", classes: "rounded"});
	      }else if(textoContra != textoRepiteContra){
	        M.toast({html:"Las contraseñas no coinciden.", classes: "rounded"});
	      }else if(textoRol == 0){
	        M.toast({html:"Seleccione un rol de usuario.", classes: "rounded"});
	      }else{
	        M.toast({html:"Creando usuario...", classes: "rounded"});
	        $.post("../php/insert_user.php", {
	            valorNombre: textoNombre,
	            valorApellidos: textoApellidos,
	            valorEmail: textoEmail,
	            valorUsuario: textoUsuario,
	            valorContra: textoContra,
	            valorRol: textoRol
	         }, function(mensaje) {
	            $("#usuariosR").html(mensaje);
	         }); 
	      }
	    };
	</script>
</head>
<body>
	<div class="container">
		<div class="row" id="usuariosR">
			<h2>Nuevo Usuario:</h2>
			<div class="row">
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="nombre">
		        <label for="nombre">Nombre</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="apellidos">
		        <label for="apellidos">Apellidos</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="email" class="validate" required id="email">
		        <label for="email">E-mail</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <input type="text" class="validate" required id="usuario">
		        <label for="usuario">Nombre de usuario</label>
		      </div>
		      <div class="input-field col s10 m5 l5">
		        <input type="password" class="validate" value="123" name="password" id="password">
		        <label for="contra">Contraseña</label>
          		<i class="bi bi-eye-slash prefix" id="togglePassword"></i>
		      </div>
		      <div class="col s1"><br></div>
		      <div class="input-field col s12 m6 l6">
		        <input type="password" class="validate" required id="repite_contra">
		        <label for="repite_contra">Repetir Contraseña</label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		          <select id="rol" class="browser-default">
		            <option value="0" selected>Seleccione un rol</option>
		            <option value="Super Admin">Super Admin</option>
		            <option value="Administrador">Administrador</option>
		            <option value="Operativo">Operativo</option>
		            <option value="Oficina">Oficina</option>
		          </select>
		          <label></label>
		      </div>
		      <div class="input-field col s12 m6 l6">
		        <a onclick="insert_usuario();" class="waves-effect waves-light btn right amber black-text"><i class="material-icons right">send</i><b>Guardar</b></a>
		      </div>
    		</div>
		</div>
	</div>
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
</html>