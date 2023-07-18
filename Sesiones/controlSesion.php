<?php 
	/* Esta función comprueba si la sesión 
	está iniciada correctamente. */
	function comprobarSesion()
	{
		session_start(); // Creamos una sesión
		/* Si no esta iniciada la sesión 
		 nos redirige a login.php*/
		if (!isset($_SESSION['usuario'])){
			header("Location: login.php");
		}
	}
	
	/* Esta función cierra la sesión 
	eliminando todas las cookies de sesión y
	nos redirige a la página de login.*/
	function cerrarSesion()
	{
	//Limpia el array de sesión
	$_SESSION=array();

	//Limpia las cookies de sesión
	if(ini_get("session.use_cookies")){
		$params = session_get_cookie_params();
		setcookie(session_name(),'',time()-42000,
			$params["path"],$params["domain"],
			$params["secure"],$params["httponly"]   
		);
	}
	
	//Destruye la sesión.
	session_destroy();
	
	header( "Location: login.php" ); // Redirigimos a la página de login
	}