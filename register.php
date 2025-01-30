<?php 

if (isset($_POST)) {

	// CARGAR CONEXIÓN A BBDD
	require_once 'includes/conection.php';

	// INICIAR SESIÓN
	if(!isset($_SESSION)){
		session_start();
	}



	// RECOGER VALORES DEL FORMULARIO DE REGISTRO

	if (isset($_POST['username'])) {
			$username =  mysqli_real_escape_string($db, $_POST['username']) ;
	}else{
		$nombre = false;
	}

	$email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email']))  : false;
	$master_key = isset($_POST['master_key']) ?  mysqli_real_escape_string($db, trim($_POST['master_key'])) : false;


	// ARRAY DE ERRORES
	$errors = array();

	
	// VALIDACIÓN DE DATOS ANTES DE GUARDARLOS EN LA BBDD


	// VALIDACIÓN DEL NOMBRE
	if (!empty($username) && !is_numeric($username) && !preg_match('/[0-9]/', $username)) {
		$validated_username = true;
	}else{
		$validated_username = false;
		$errors['username'] = "Invalid username";
	}


	// VALIDAR EL EMAIL
		if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$validated_email = true;
	}else{
		$validated_email = false;
		$errors['email'] = "Invalid email";
	}

	// VALIDAR LA CONTRASEÑA
		if (!empty($master_key)) {
		$validated_master_key = true;
	}else{
		$validated_master_key = false;
		$errors['master_key'] = "Enter a valid password";
	}

	// Comprobar si hay errores
	$save_user = false;
	if (count($errors) == 0) {
		$save_user = true;


	// Cifrar la contraseña antes de guardarla
		$save_password = password_hash($master_key, PASSWORD_BCRYPT, ['cost' => 4]);




		// Insertar usuario en la base de datos

		$sql = "INSERT INTO users VALUES(null, '$username' , '$email', '$save_password');";

		$save = mysqli_query($db, $sql);



		if($save){
			$_SESSION['completed'] = "You have registered your account";
		}else{
			$_SESSION['errors']['general'] = "Failed to save user";
		}

	}else{
		$_SESSION['errors'] = $errors;
		
	}
}
header('Location: account.php');
?>