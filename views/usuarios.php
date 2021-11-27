<!DOCTYPE html>
<html>
<head>
	<title>Carnicos Norte | Usuarios</title>
	<?php
	include('Nav.php')
	?>
	<script>
	  function cancelar(id){
	    M.toast({html:"Cancelando usuario...", classes: "rounded"});
	    $.post("../php/cancelar_user.php", {
            valorId: id,
        }, function(mensaje) {
              $("#resultado").html(mensaje);
        }); 
	  }
	</script>
</head>
<body>
	<div class="container" id="resultado">
		<div class="row">
			<h2>Usuarios:</h2>
			<a href="form_usuario.php" class="waves-effect waves-light btn right amber black-text"><i class="material-icons right">person_add</i><b>Nuevo Usuario</b></a>
		</div>
		<table class="striped responsive-table">
			<thead>
	          <tr>
	              <th>ID</th>
	              <th>Nombre(s)</th>
                  <th>Apellidos</th>
                  <th>Usuario</th>
                  <th>E-mail</th>
                  <th>Rol</th>
                  <th>Editar</th>
                  <th>Cancelar</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php             
              $sql_tmp = mysqli_query($conn,"SELECT * FROM users WHERE tipo != 'Cancelado'");
              $filas = mysqli_num_rows($sql_tmp);
              if($filas == 0){
                ?> <h5 class="center">No hay usuarios</h5> <?php
              }else{
                while($tmp = mysqli_fetch_array($sql_tmp)){
                ?>
                  <tr>
                    <td><?php echo $tmp['user_id']; ?></td>
                    <td><?php echo $tmp['firstname']; ?></td>
                    <td><?php echo $tmp['lastname']; ?></td>
                    <td><?php echo $tmp['user_name']; ?></td>
                    <td><?php echo $tmp['user_email']; ?></td>
                    <td><?php echo $tmp['tipo']; ?></td>
                    <td><form method="post" action="../views/editar_user.php"><input name="user_id" type="hidden" value="<?php echo $tmp['user_id']; ?>"><button type="submit" class="btn-floating btn-tiny waves-effect waves-light amber"><i class="material-icons black-text">edit</i></button></form></td>
                    <td><a onclick="cancelar(<?php echo $tmp['user_id'];?>);" class="btn-floating btn-tiny waves-effect waves-light red darken-2"><i class="material-icons black-text">cancel</i></a></td>
                  </tr>
                <?php
                }
              }
              mysqli_close($conn);
              ?>
	        </tbody>
		</table>
	</div>
</body>
</html>