<!DOCTYPE html>
<html data-bs-theme="<?php print TEMA; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultorio médico | <?php print $datos["titulo"]; ?></title>
	<link rel="shortcut icon" href="<?php print RUTA; ?>public/img/favicon.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php print RUTA; ?>public/css/main.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm colornav px-3">
		<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
	      <span class="navbar-toggler-icon"></span>
	    </button>
		<a href="<?php print RUTA.'tablero/'; ?>" class="navbar-brand"><img src="<?php print RUTA; ?>public/img/logo.jpg" width="40" alt="Inicio"/></a>
		<div class="collapse navbar-collapse" id="navbarMenu">
		<?php
		if (isset($datos["menu"]) && $datos["menu"]==true) {
			if (isset($datos["admon"]) && $datos["admon"]==true) {
			  print "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
		      print "<li class='nav-item'>";
		      print "<a href='".RUTA."doctores' class='nav-link ";
		      if(isset($datos["activo"]) && $datos["activo"]=="doctores") print "active";
		      print "'>Doctores</a>";
		      print "</li>";
		      //
		      print "<li class='nav-item'>";
		      print "<a href='".RUTA."pacientes' class='nav-link ";
		      if(isset($datos["activo"]) && $datos["activo"]=="pacientes") print "active";
		      print "'>Pacientes</a>";
		      print "</li>";
		      //
		      print "<li class='nav-item'>";
		      print "<a href='".RUTA."citas' class='nav-link ";
		      if(isset($datos["activo"]) && $datos["activo"]=="citas") print "active";
		      print "'>Citas</a>";
		      print "</li>";
		      //
		      print "<li class='nav-item'>";
		      print "<a href='".RUTA."horarios' class='nav-link ";
		      if(isset($datos["activo"]) && $datos["activo"]=="horarios") print "active";
		      print "'>Horarios</a>";
		      print "</li>";
		      print "</ul>";
		  }
		  if (isset($datos["admon"]) && $datos["admon"]==false) {
			  print "<ul class='navbar-nav mr-auto mt-2 mt-lg-0'>";
		      print "<li class='nav-item'>";
		      print "<a href='".RUTA."historial' class='nav-link ";
		      if(isset($datos["activo"]) && $datos["activo"]=="historial") print "active";
		      print "'>Historial de paciente</a>";
		      print "</li>";
		      print "</ul>";

		  }
	      //
	      print "<ul class='nav navbar-nav ms-auto'>";
	      //
	      print "<li class='nav-item'>";
	      print "<a href='".RUTA."tablero/perfil' class='nav-link'>";
	      print '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/></svg>';
	      print "</a>";
	      print "</li>";
	      print "<li class='nav-item'>";
	      print "<a href='".RUTA."tablero/logout' class='nav-link'>";
	      print '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/><path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>';
	      print "</a>";
	      print "</li>";
	      print "</ul>";
	    }  
	?>
	</div> <!-- división colapsable -->
	</div> <!-- división container-fluid -->
	</nav>
	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php  
				if (isset($datos["errores"])) {
					if (count($datos["errores"])>0) {
						print "<div class='alert alert-danger mt-3'>";
						foreach ($datos["errores"] as $valor) {
							print "<strong>* ".$valor."</strong><br>";
						}
						print "</div>";
					}
				}

				?>