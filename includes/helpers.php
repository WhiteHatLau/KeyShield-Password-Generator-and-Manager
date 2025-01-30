<?php function getPasswords($conection, $user_id) {
    $sql = "SELECT p.*, c.category_name AS 'categoria' FROM passwords p " .
           "INNER JOIN categories c ON p.category_id = c.category_id " .
           "WHERE p.user_id = $user_id";  // Filtramos por el ID del usuario

    $result = mysqli_query($conection, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return false;  // No hay contraseñas para mostrar
    }
}


?>