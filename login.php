<?php

// Iniciar sesión y conexión a la base de datos

require_once 'includes/conection.php';


// Recoger datos del formulario

if(isset($_POST)){
	// Borrar sesión de error (de intentos fallidos de login anteriores)
	if(isset($_SESSION['login_error'])){
	unset($_SESSION['login_error']);
	}


	// Recoger datos del formulario

	$email = trim($_POST['email']);
	$master_key = $_POST['master_key'];


	
	// Consulta a la BBDD para ver si email y contraseña introducidos coinciden con los registros de la BBDD y si coinciden logear


	// Consulta para comprobar credenciales del usuario
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$login = mysqli_query($db, $sql);

	// Comprueba si login da true y si el nº de filas que devuelve la consulta es en este caso 1
	if($login && mysqli_num_rows($login) == 1){

		$user = mysqli_fetch_assoc($login);			// Saca array asociativo con los datos que devuelve la consulta
	

			// Comprobar la contraseña / cifrar

			$verify = password_verify($master_key, $user['master_key']); 		// Saca contraseña del array asociativo de antes (la que está en la BBDD, y la compara con la que acabamos de introducir en el login)

			if($verify){
				// Utilizar sesión para guardar datos del usuario logeado
				$_SESSION['user'] = $user;


			}else{
				// Si algo falla crear sesión con el fallo
				$_SESSION['login_error'] = "Error logging in.";
			}

	}else{
		// Mensaje de error
		$_SESSION['error_login'] = "Error logging in.";
	}
}




// Redirigir al dashboard
header('location: dashboard.php');

?>

redirection.php: <?php 
// Hacer páginas solo accesibles cuando se está registrado en la página
if(!isset($_SESSION)){
	session_start();
}

if (!isset($_SESSION['user'])) {
	header("Location: account.php");
}

?>