<?php
include('../php/conexion.php');
#include '../php/is_logged.php';
$Hoy = date('Y-m-d');

$Seguro = 0;# mysqli_fetch_array(mysqli_query($conn, "SELECT  * FROM users"));

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
	  <link rel="shortcut icon" href="img/LOGO.jpg" type="image/jpg" />
      <style rel="stylesheet">
		.dropdown-content{ overflow: visible; }
	  </style>
	<div class="navbar-fixed">
		<nav class="red darken-2">
		    <div class="nav-wrapper container">
		      <a href="home.php" class="brand-logo center hide-on-small-only"><img  class="responsive-img" width="14%" src="img/Logo_CN.png"></a>
		      <a href="home.php" class="brand-logo center hide-on-med-and-up"><img  class="responsive-img" width="26%" src="img/Logo_CN.png"></a>
		      <a href="#" data-target="menu-responsive" class="sidenav-trigger">
				<i class="material-icons">menu</i>
			  </a>
		      <ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a class='dropdown-button' data-target='dropdown1'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">people</i>Admin</a></li>
		        <ul id='dropdown1' class='dropdown-content'>
					<li><a href="usuarios.php" class="black-text"><i class="material-icons">list</i>Usuarios</a></li>
		 		</ul>
		        <li><a class='dropdown-button' data-target='dropdown2'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">edit</i>Oficina</a></li>
		        <ul id='dropdown2' class='dropdown-content'>
					<li><a href="pedidos.php" class="black-text"><i class="material-icons">add_circle_outline</i>Pedidos</a></li>
					<li><a href="rutas.php" class="black-text"><i class="material-icons">storage</i>Rutas</a></li>
		 		</ul>
		      </ul>
		      <ul class="right hide-on-med-and-down">
		      	<li><a class='dropdown-button' data-target='dropdown3'><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">local_shipping</i>Operativo</a></li>
				<ul id='dropdown3' class='dropdown-content'>
					<li><a href="Pedidos.php" class="black-text"><i class="material-icons">assessment</i>Pedidos</a></li>
					<li><a href="#" class="black-text"><i class="material-icons">lock</i>Mas<span class="new badge red" data-badge-caption=""><?php echo $Seguro;#['count(*)'];?></span></a></li>
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
    	<li><div class="divider"></div></li><br>
		<li>
	    	<ul class="collapsible collapsible-accordion">
	    		<li>
	    			<div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">people</i>Admin</div>
		      		<div class="collapsible-body blue-grey lighten-3">
		      			<span><ul>
							<li><a href="usuarios.php"><i class="material-icons">list</i>Usuarios</a></li>
					    </ul></span>
		      		</div>    			
	    		</li>	    			
	    	</ul>	     				
	    </li>
	    <li>
	    	<ul class="collapsible collapsible-accordion">
	    		<li>
	    			<div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">edit</i>Oficina</div>
		      		<div class="collapsible-body blue-grey lighten-3">
		      			<span><ul>
		      				<li><a href="pedidos.php"><i class="material-icons">add</i>Pedios</a></li>  
					    </ul></span>
		      		</div>    			
	    		</li>	    			
	    	</ul>	     				
	    </li>
	    <li>
	    	<ul class="collapsible collapsible-accordion">
	    		<li>
	    			<div class="collapsible-header"><i class="material-icons right">arrow_drop_down</i><i class="material-icons left">local_shipping</i>Operativo</div>
		      		<div class="collapsible-body blue-grey lighten-3">
		      			<span><ul>		      					  
								<li><a href="pedidos.php"><i class="material-icons">assessment</i>Pedidos</a></li>
								<li><a href="#"><i class="material-icons">lock</i>Mas<span class="new badge red" data-badge-caption=""><?php echo $Seguro;#['count(*)'];?></span></a></li>
					    </ul></span>
		      		</div>    			
	    		</li>	    			
	    	</ul>	     				
	    </li>
	</ul>
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
