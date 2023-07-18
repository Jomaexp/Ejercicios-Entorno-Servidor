<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset = 'UTF-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Tarea 3 - Programación básica</title>
		<style>
			@import url('style3.css');
		</style>
	</head>	

	<body>
		<header>
		<h1>Tarea 3 - Programación básica</h1> 
		</header>
		
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
			<legend>Calcular los valores del array</legend>
			<div>
				<label for="valor">Numero para obtener el array</label>
				<input type="text" name="valor" id="valor" />
				<input type="submit" name="enviar" id="boton" />	
			</div>
		</form>	
		
		<?php
		include("funciones.php");
		?>
		
	</body>
</html>