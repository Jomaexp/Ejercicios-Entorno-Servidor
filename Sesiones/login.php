<?php
//Iniciamos sesión y flujo.
session_start();
ob_start();
?>

<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset= 'UTF-8'/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Tarea 4 - Autentificación</title>
		<style>
			@import url('style.css');
		</style>
	</head>
	<body>

	<form class="formu" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
		<legend id="titulo">Ingrese sus credenciales</legend>
		<input class="entrada" type="text" name="usuario" placeholder="usuario" id="usuario"/>
		<input class="entrada" type="password" name="contrasena" placeholder="contraseña" id="contrasena"/>
		<br>
		<h2 class="msg" id="mensaje"></h2>
		<input class="boton" type="submit" name="boton" value="Iniciar sesión"/>
	</form>
		<?php
		// Si se ha enviado algo por post se ejecuta el código.
		if($_POST){
			$pass=crypt('password','$1$somethin$');
			//Comprobar que el nombre y contraseña no están vacíos
			if(isset($_POST['usuario'])) $usuario = $_POST['usuario'];
			else $usuario = "";
			
			if(isset($_POST['contrasena'])) $contrasena = $_POST['contrasena'];
			else $contrasena = "";
			// Comprobamos si usuario y contraseña no están vacíos.
			if ($usuario != "" && $contrasena !=""){
				// Autenticamos al usuario con la contraseña.
				if ($usuario == "user" && crypt($contrasena,'$1$somethin$') == $pass){
					// Se crea la variable de sesión y se le asigna el valor del usuario.
					$_SESSION['usuario'] = $usuario;
					header("Location: sesion.php");  // Redirige a la página "sesion.php".
				// Si no se autentica muestra "Credenciales incorrectas" dentro de la etiqueta id "mensaje".
				}else	echo "<script> document.getElementById('mensaje').innerHTML=
											'Credenciales incorrectas';</script>";
			/* Si usuario o contraseña están vacíos se muestra el mensaje "Introduzca usuario y contraseña"
				dentro de la etiqueta id "mensaje".*/
			}else echo "<script> document.getElementById('mensaje').innerHTML=
								'Introduzca usuario y contraseña';</script>";
		}		
		?>
	</body>
</html>
<!-- Ahora cerramos el flujo para no tener errores php en el navegador -->
<?php ob_end_flush();

?>
