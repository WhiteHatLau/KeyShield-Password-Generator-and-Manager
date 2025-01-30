<?php
// Iniciar sesión y verificar que el usuario esté conectado
session_start();

// Verificar si el usuario está conectado
if (!isset($_SESSION['user'])) {
    die("User not logged in.");
}

// Conectar a la base de datos
require_once 'includes/conection.php';

// Verificar si se ha enviado el ID de la contraseña para eliminar
if (isset($_POST['password_id'])) {
    $password_id = $_POST['password_id'];

    // Verificar si el ID de la contraseña es válido
    if (is_numeric($password_id)) {
        // Verificar si la contraseña pertenece al usuario logueado
        $user_id = $_SESSION['user']['user_id'];
        $sql_check = "SELECT * FROM passwords WHERE password_id = $password_id AND user_id = $user_id";
        $result = mysqli_query($db, $sql_check);

        if (mysqli_num_rows($result) > 0) {
            // La contraseña existe y pertenece al usuario logueado, proceder con la eliminación
            $sql_delete = "DELETE FROM passwords WHERE password_id = $password_id";
            $delete_result = mysqli_query($db, $sql_delete);

            if ($delete_result) {
                $_SESSION['message'] = "Password deleted successfully.";
            } else {
                $_SESSION['error'] = "Error deleting the password.";
            }
        } else {
            $_SESSION['error'] = "Password not found or doesn't belong to the user.";
        }
    } else {
        $_SESSION['error'] = "Invalid password ID.";
    }
} else {
    $_SESSION['error'] = "Password ID not provided.";
}

// Redirigir de nuevo al dashboard o donde desees
header('Location: dashboard.php');
exit();
?>
