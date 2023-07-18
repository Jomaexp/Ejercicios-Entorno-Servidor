<?php
/* Ahora requerimos el uso del script "controlSesion.php".
Tras ejecutar la función "comprobarSesion()" vamos a iniciar
el flujo. */
require "controlSesion.php";
comprobarSesion();
ob_start(); ?>

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
			<?php
				
				$usr=$_SESSION['usuario']; 
				/* Esta función comprueba si el valor introducido en el
				   argumento es un número de 9 cifras, es decir, un teléfono.*/
				function comprobarTlf($numero){
					if(is_numeric($numero) && (strlen($numero)==9)){
						return true;
					}else return false;
				}	
				//  Comprobamos si se ha pulsado el botón "sub".
				if (isset($_POST['sub'])){
					/* Las instrucciones contenidas sirven para controlar que
					los valores de los campos telefono y email son correctos 
					con el formato esperado antes de guardar esos valores en 
					variables de sesión. */
					if(isset($_POST['telefono']) && comprobarTlf($_POST['telefono'])){ 
						$telefono = $_POST['telefono'];
					}else{ $telefono = "";}

					if(isset($_POST['email'])){ $email = $_POST['email'];
					}	else{ $email = "";
						}

					if ($telefono != "" && $email !=""){
							$_SESSION['telefono']=$telefono;
							$_SESSION['email']=$email;	
						}
				}
				/* Si los valores de sesión teléfono y email están seteados se
				asignan sus valores a las variables correspondientes.*/
				if(isset($_SESSION['telefono']) && isset($_SESSION['email'])){
					$telefono=$_SESSION['telefono'];
					$email=$_SESSION['email'];
				}
				/* Si se ha pulsado el botón "rst" se borrará la cookie "horario"
				de estar seteada y, después, se cierra la sesión con la función
				cerrarSesion(). */
				if (isset($_POST['rst'])){
					if(isset($_COOKIE['horario'])){
						setcookie("horario","", time()-3600);
					}
					cerrarSesion();
				}
				/* Si se ha pulsado el botón "subcookie" se creará la cookie
				"horario" y se asignará a la variable $hora la opción "horas".
				Si no se controlará si ya existe la cookie para darle su valor
				a la variable "$hora" o darle valor por defecto. */
				if(isset($_POST['subcookie'])){
					$hora=$_REQUEST['horas'];
					setcookie("horario", $hora, time()+3600);
				}else 	if (isset($_COOKIE['horario'])){ 
							$hora=($_COOKIE['horario']); 
						}else $hora='Mañana';
						
		?>	 

		<form class="formu" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
				<h2 class="msg" id="saludo">Bienvenido usuario: <?php echo $usr; ?></h2>
				<input class="entrada" type="text" name="telefono" id="telefono" placeholder="introduzca su teléfono (9 cifras)" value="<?php if(isset($_SESSION['telefono'])) echo $_SESSION['telefono']; ?>"/>
				<br>
				<input class="entrada" type="email" name="email" id="email" placeholder="introduzca su email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>"/>
				<br>
				<h2 class="msg" id="mensaje"></h2>
				<?php 
					/* Si están seteadas tanto $telefono como $email y estos son ambos 
					distintos a cadena vacía se mostrará el mensaje "Introduzca teléfono y email válidos" 
					dentro de la etiqueta con id "mensaje". */
					if (isset($telefono) && isset($email)){
						if ($telefono == "" || $email ==""){
							echo "<script> document.getElementById('mensaje').innerHTML='Introduzca teléfono y email válidos.';</script>";						
						}
					}
				?>
				<input class="boton" type="submit" name="sub" id="sub" value="Grabar"/>
				<input class="boton" type="submit" name="rst" id="rst" value="Borrar"/>
				<label class="hor" for="horas">Horario: </label>
				<select class="opcion" id="horas" name="horas">
					<!-- Los option contienen una condición if en php para seleccionar
					el valor según sea el valor actual de $hora. -->
					<option class='opcion' value='Mañana'<?php if ($hora=='Mañana') echo "selected"; ?> >Mañana</option>
					<option class='opcion' value='Tarde'<?php if ($hora=='Tarde') echo "selected"; ?>>Tarde</option>
					<option class='opcion' value='Noche'<?php if ($hora=='Noche') echo "selected"; ?>>Noche</option>
				</select>
				<h2 class="msg" id="mensajehorario"></h2>
				<?php
					/* Si se ha pulsado el botón "subcookie" se mostrará el mensaje
					"Horario grabado" dentro de la etiqueta con id "mensajehorario". */
					if(isset($_POST['subcookie'])){
						echo "<script> document.getElementById('mensajehorario').innerHTML='Horario grabado.';</script>";
					}
				?>
				<input class="boton" type="submit" name="subcookie" id="subcookie" value="Grabar horario"/>
		</form>

	</body>
</html>
<!-- Ahora cerramos el flujo para no tener errores php en el navegador -->
<?php ob_end_flush();

?>