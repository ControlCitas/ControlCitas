<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultorio médico</title>
	<link rel="shortcut icon" href="../public/ing/favicon.ico">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbat-espand-sm bg-dark navbar-dark">
		<a href="" class="navbar-brand">Consultorio</a>
	</nav>
	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h1 class="text-center">Login</h1>
				<div class="card p-4 bg-light">
					<form action="">
						<div class="form-group text-left">
							<label for="usuario">* Usuario:</label>
							<input type="text" name="usuario" class="form-control" placeholder="Escribe tu usuario (tu correo electrónico)">
						</div>
						<div class="form-group text-left">
							<label for="clave">* Clave de acceso:</label>
							<input type="password" name="clave" class="form-control" placeholder="Escribe tu clave de acceso">
						</div>
						<div class="form-group text-left">
							<input type="submit" value="Enviar" class="btn btn-success">
							<input type="checkbox" name="recordar">
							<label for="recordar">Recordar</label>
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
</body>
</html>