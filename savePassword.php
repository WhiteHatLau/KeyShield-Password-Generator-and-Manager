<?php 

if (isset($_POST)) {

	// CARGAR CONEXIÓN A BBDD
	require_once 'includes/conection.php';

	// INICIAR SESIÓN
	if(!isset($_SESSION)){
		session_start();
	}


	// Verificar que el usuario esté conectado
	if (isset($_SESSION['user'])) {
    	$user_id = $_SESSION['user']['user_id']; // Recuperar el ID del usuario desde la sesión
	} else {
    	// Manejo de error si no está conectado
    	die("User not logged in.");
	}

	// RECOGER VALORES DEL FORMULARIO DE CREACIÓN DE CONTRASEÑA

	if (isset($_POST['password_name'])) {
			$password_name =  mysqli_real_escape_string($db, $_POST['password_name']) ;
	}else{
		$password_name = false;
	}

	$category = isset($_POST['category']) && is_numeric($_POST['category']) ? intval($_POST['category']) : false;

	$value = isset($_POST['value']) ?  mysqli_real_escape_string($db, trim($_POST['value'])) : false;

	$tag = isset($_POST['tag']) && !empty(trim($_POST['tag'])) ? mysqli_real_escape_string($db, trim($_POST['tag'])) : null;


	// ARRAY DE ERRORES
	$errors = array();

	
	// VALIDACIÓN DE DATOS ANTES DE GUARDARLOS EN LA BBDD


	// NOMBRE
	if (!empty($password_name) && !is_numeric($password_name) && !preg_match('/[0-9]/', $password_name)) {
		$validated_password_name = true;
	}else{
		$validated__password_name = false;
		$errors['password_name'] = "Invalid Name";
	}
// CATEGORIA
if (!empty($category)) {
    // Validar que la categoría sea un entero positivo
    if (filter_var($category, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $validated_category = true;
    } else {
        $validated_category = false;
        $errors['category'] = "Invalid Category ID";
    }
} else {
    $validated_category = false; 
}




	// VALOR
		if (!empty($value)) {
		$validated_value = true;
	}else{
		$validated_value = false;
		$errors['value'] = "Enter a valid password";
	}




	// Comprobar si hay errores
	$save_password = false;
	if (count($errors) == 0) {
		$save_password = true;





		// Guardar contraseña en la base de datos
		// fecha actual
		$last_modify_date = date('Y-m-d');

		$sql = "INSERT INTO passwords (user_id, password_name, value, last_modify_date, category_id) 
            VALUES ('$user_id', '$password_name', '$value', '$last_modify_date', '$category')";

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
header('Location: dashboard.php');
?>