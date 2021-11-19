<?php
#include('../php/conexion.php');
#include '../php/is_logged.php';
$Hoy = date('Y-m-d');
$nuevafecha = 0;#strtotime('+8 days', strtotime($Hoy));
$MasSemana = 0;#date('Y-m-d', $nuevafecha);
$Seguro = 0;#mysqli_fetch_array(mysqli_query($conn, "SELECT  count(*) FROM unidades WHERE vigencia_p <= '$MasSemana'"));
$Verificacion = 0;#mysqli_fetch_array(mysqli_query($conn, "SELECT  count(*) FROM unidades WHERE vigencia_v <= '$MasSemana'"));
$Fisico = 0;#mysqli_fetch_array(mysqli_query($conn, "SELECT  count(*) FROM unidades WHERE vigencia_f <= '$MasSemana'"));
$Tenencia = 0;# mysqli_fetch_array(mysqli_query($conn, "SELECT  count(*) FROM unidades WHERE fecha_renovar <= '$MasSemana' AND fecha_renovar > '2019-01-01'"));
$Predio = 0;#mysqli_fetch_array(mysqli_query($conn, "SELECT  count(*) FROM propiedades WHERE fecha_predio <= '$MasSemana'"));
?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--Import material-icons.css-->
      <link href="css/material-icons.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <link rel="shortcut icon" href="img/Logo_CN.png" type="image/png" />
      <style rel="stylesheet">
		.dropdown-content{  overflow: visible;	}
	</style>
	<div class="navbar-fixed">
	<nav class="red darken-2">
    <div class="nav-wrapper container">
      <a href="home.php" class="brand-logo center"><img  class="responsive-img" style="width: 73px; height: 85px;" src="img/Logo_CN.png"></a>
      <a href="#" data-target="menu-responsive" class="sidenav-trigger">
		<i class="material-icons">menu</i>
	  </a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class='dropdown-button' data-target='dropdown1'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">people</i>Admin</a></li>
        <ul id='dropdown1' class='dropdown-content'>
			<li><a href="crear_usuario.php" class="black-text"><i class="material-icons">add</i>Nuevo Usuario</a></li>
			<li><a href="usuarios.php" class="black-text"><i class="material-icons">list</i>Usuarios</a></li>
			<li><a href="unidades_admin.php" class="black-text"><i class="material-icons">local_shipping</i>Unidades</a></li>
			<li><a href="ventas_proceso.php" class="black-text"><i class="material-icons">monetization_on</i>Ventas Proceso</a></li>
			<li><a href="ventas_completadas.php" class="black-text"><i class="material-icons">attach_money</i>Ventas Completadas</a></li>
 		</ul>
        <li><a class='dropdown-button' data-target='dropdown2'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">edit</i>Oficina</a></li>
        <ul id='dropdown2' class='dropdown-content'>
			<li><a href="crear_operador.php" class="black-text"><i class="material-icons">add</i>Nuevo Operador</a></li>
			<li><a href="operadores.php" class="black-text"><i class="material-icons">list</i>Operadores</a></li>
			<li><a href="crear_unidad.php" class="black-text"><i class="material-icons">add_box</i>Nueva Unidad</a></li>
			<li><a href="unidades.php" class="black-text"><i class="material-icons">local_shipping</i>Unidades</a></li>
			<li><a href="crear_ruta.php" class="black-text"><i class="material-icons">add_circle_outline</i>Nueva Ruta</a></li>
			<li><a href="rutas.php" class="black-text"><i class="material-icons">storage</i>Rutas</a></li>
			<li><a href="crear_propiedad.php" class="black-text"><i class="material-icons">add_to_photos</i>Nueva Propiedad</a></li>
			<li><a href="propiedades.php" class="black-text"><i class="material-icons">format_list_numbered</i>Propiedades</a></li>
			<li><a href="expedientes.php" class="black-text"><i class="material-icons">filter_none</i>Expedientes</a></li>

 		</ul>
      </ul>
      <ul class="right hide-on-med-and-down">
      	<li><a class='dropdown-button' data-target='dropdown3'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">local_shipping</i>Operativo</a></li>
		<ul id='dropdown3' class='dropdown-content'>
			<li><a href="reporte_rendimiento.php" class="black-text"><i class="material-icons">assessment</i>Rendimiento</a></li>
			<li><a href="reporte_seguro.php" class="black-text"><i class="material-icons">lock</i>Seguro<span class="new badge red" data-badge-caption=""><?php echo $Seguro;#['count(*)'];?></span></a></li>
			<li><a href="reporte_verificacion.php" class="black-text"><i class="material-icons">settings_applications</i>Verificacion<span class="new badge red" data-badge-caption=""><?php echo $Verificacion;#['count(*)'];?></span></a></li>
			<li><a href="reporte_fisico.php" class="black-text"><i class="material-icons">touch_app</i>Fisico Mecanico<span class="new badge red" data-badge-caption=""><?php echo $Fisico;#['count(*)'];?></span></a></li>
			<li><a href="reporte_tenencia.php" class="black-text"><i class="material-icons">list</i>Tenencia<span class="new badge red" data-badge-caption=""><?php echo $Tenencia;#['count(*)'];?></span></a></li>
			<li><a href="reporte_predio.php" class="black-text"><i class="material-icons">assignment_turned_in</i>Predio<span class="new badge red" data-badge-caption=""><?php echo $Predio;#['count(*)'];?></span></a></li>

 		</ul>
        <li><a class='dropdown-button' data-target='dropdown4'> <i class="material-icons right">arrow_drop_down</i><?php echo '$_SESSION[]';?></a></li>
		<ul id='dropdown4' class='dropdown-content'>
			<li><a href="../php/cerrar_sesion.php" class="black-text"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
 		</ul>
	  </ul>	
	  <ul class="right hide-on-large-only hide-on-small-only">
			<li><a class='dropdown-button' data-target='dropdown10'> <i class="material-icons right">arrow_drop_down</i> <i class="material-icons right">face</i> .</a></li>
			<ul id='dropdown10' class='dropdown-content'>
				<li><a href="../php/cerrar_sesion.php" class="black-text"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
 			</ul>
	  </ul>
	  <ul class="right hide-on-med-and-up">
		<li><a class='dropdown-button' data-target='dropdown8'><i class="material-icons left">account_circle</i><b>></b></a></li>
		<ul id='dropdown8' class='dropdown-content'>
			<li><a href="../php/cerrar_sesion.php" class="black-text"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
 		</ul>
	  </ul>			
	</div>		
	</nav>
	</div>
	<ul class="sidenav blue-grey lighten-3" id="menu-responsive" style="width: 270px;">
				<h2>Menú</h2>
    			<li><div class="divider"></div></li>
    			<br>
				<li>
	    			<ul class="collapsible collapsible-accordion">
	    				<li>
	    				  <div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">people</i>Admin</div>
		      				<div class="collapsible-body blue-grey lighten-3">
		      				  <span>
		      					<ul>
		      					  <li><a href="crear_usuario.php"><i class="material-icons">add</i>Nuevo Usuario</a></li>
								  <li><a href="usuarios.php"><i class="material-icons">list</i>Usuarios</a></li>
								  <li><a href="unidades_admin.php"><i class="material-icons">local_shipping</i>Unidades</a></li>
								  <li><a href="ventas_proceso.php"><i class="material-icons">monetization_on</i>Ventas Proceso</a></li>
								  <li><a href="ventas_completadas.php"><i class="material-icons">attach_money</i>Ventas Completadas</a></li>
					    		</ul>
					          </span>
		      			  </div>    			
	    				</li>	    			
	    			</ul>	     				
	    		</li>
	    		<li>
	    			<ul class="collapsible collapsible-accordion">
	    				<li>
	    				  <div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">edit</i>Oficina</div>
		      				<div class="collapsible-body blue-grey lighten-3">
		      				  <span>
		      					<ul>
		      					  <li><a href="crear_operador.php"><i class="material-icons">add</i>Nuevo Operador</a></li>
								  <li><a href="operadores.php"><i class="material-icons">list</i>Operadores</a></li>
								  <li><a href="crear_unidad.php"><i class="material-icons">add_box</i>Nueva Unidad</a></li>
								  <li><a href="unidades.php"><i class="material-icons">local_shipping</i>Unidades</a></li>
								  <li><a href="crear_ruta.php"><i class="material-icons">add_circle_outline</i>Nueva Ruta</a></li>
								  <li><a href="rutas.php"><i class="material-icons">storage</i>Rutas</a></li>
								  <li><a href="crear_propiedad.php"><i class="material-icons">add_to_photos</i>Nueva Propiedad</a></li>
								  <li><a href="propiedades.php"><i class="material-icons">format_list_numbered</i>Propiedades</a></li>
								  <li><a href="expedientes.php"><i class="material-icons">filter_none</i>Expedientes</a></li>
					    		</ul>
					          </span>
		      			  </div>    			
	    				</li>	    			
	    			</ul>	     				
	    		</li>
	    		<li>
	    			<ul class="collapsible collapsible-accordion">
	    				<li>
	    				  <div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">local_shipping</i>Operativo</div>
		      				<div class="collapsible-body blue-grey lighten-3">
		      				  <span>
		      					<ul>		      					  
									<li><a href="reporte_rendimiento.php"><i class="material-icons">assessment</i>Rendimiento</a></li>
									<li><a href="reporte_seguro.php"><i class="material-icons">lock</i>Seguro<span class="new badge red" data-badge-caption=""><?php echo $Seguro;#['count(*)'];?></span></a></li>
									<li><a href="reporte_verificacion.php"><i class="material-icons">settings_applications</i>Verificacion<span class="new badge red" data-badge-caption=""><?php echo $Verificacion;#['count(*)'];?></span></a></li>									
									<li><a href="reporte_fisico.php"><i class="material-icons">touch_app</i>Fisico Mecanico<span class="new badge red" data-badge-caption=""><?php echo $Fisico;#['count(*)'];?></span></a></li>
									<li><a href="reporte_tenencia.php"><i class="material-icons">list</i>Tenencia<span class="new badge red" data-badge-caption=""><?php echo $Tenencia;#['count(*)'];?></span></a></li>
									<li><a href="reporte_predio.php"><i class="material-icons">assignment_turned_in</i>Predio<span class="new badge red" data-badge-caption=""><?php echo $Predio;#['count(*)'];?></span></a></li>
					    		</ul>
					          </span>
		      			  </div>    			
	    				</li>	    			
	    			</ul>	     				
	    		</li>
	</ul>
	<?php 
	?>
	<script src="js/jquery-3.1.1.js"></script>
	<!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
	<script>
    	$(document).ready(function() {
	    
	 	});
	 	$('.dropdown-button').dropdown({
	      	  inDuration: 500,
	          outDuration: 500, constrainWidth: false, // Does not change width of dropdown to that of the activator
	          coverTrigger: false, 
	    });
	    $('.dropdown-btn').dropdown({
	      	  inDuration: 500,
	          outDuration: 500,
	          hover: true,
	          constrainWidth: false, // Does not change width of dropdown to that of the activator
	          coverTrigger: false, 
	    });
		document.addEventListener('DOMContentLoaded', function(){
			M.AutoInit();
		});
		document.addEventListener('DOMContentLoaded', function() {
		    var elems = document.querySelectorAll('.fixed-action-btn');
		    var instances = M.FloatingActionButton.init(elems, {
		      direction: 'left'
		    });
		});
	</script>
