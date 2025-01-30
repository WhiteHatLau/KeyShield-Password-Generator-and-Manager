<?php
// Iniciar sesión y conexión a la base de datos
require_once 'includes/conection.php';

//redireccionar a inicio si hay una sesión iniciada
require_once 'includes/redirection.php';
require_once 'includes/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contraseñas</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <h1>Your Passwords</h1>
            <button id="dark-mode-toggle" class="dark-mode-btn">Dark Mode</button> 
        </div>

        <!-- Búsqueda -->
        <div class="search-section">
            <input type="text" id="search" placeholder="Search password..." class="search-bar">

        </div>

        <!-- Lista de contraseñas -->
        
        <div class="passwords-list">

<?php
$user_id = $_SESSION['user']['user_id'];  // Obtener el ID del usuario logueado

$passwords = getPasswords($db, $user_id);

if ($passwords):  // Si hay contraseñas guardadas por el usuario
    while ($password = mysqli_fetch_assoc($passwords)): 
?>
    <div class="password-item">
        <div class="password-header">
            <span class="password-title"><?= htmlspecialchars($password['password_name']) ?></span>
            <div class="password-tags">
                <span class="tag"><?= htmlspecialchars($password['categoria']) ?></span>
            </div>
        </div>
        <div class="password-details">
            <p>Password: <strong><?= htmlspecialchars($password['value']) ?></strong></p>
            <p>Last update: <strong><?= htmlspecialchars($password['last_modify_date']) ?></strong></p>
            <!-- Formulario de eliminación con el ID de la contraseña -->
            <form action="deletePassword.php" method="POST" style="display:inline;">
                <input type="hidden" name="password_id" value="<?= $password['password_id'] ?>">
                <button type="submit" class="delete-btn">Eliminar</button>
            </form>
            <!-- Formulario de edición con el ID de la contraseña -->
            <form action="editPassword.php" method="POST" style="display:inline;">
                <input type="hidden" name="password_id" value="<?= $password['password_id'] ?>">
                <button type="submit" class="edit-btn">Edit</button>
            </form>
        </div>
    </div>
<?php
    endwhile;
else:
    echo "<p>You haven't saved any password yet.</p>";
endif;
?>


        </div>

        <!-- Enlace para agregar más contraseñas -->
        <a href="passwordManager.php" class="floating-btn"> + </a>
    </div>

    <!-- Barra de navegación inferior -->
    <nav class="bottom-nav">
        <a href="logout.php" class="nav-link">
            <span class="nav-icon">🚪</span> 
            <span class="nav-label">Log Out</span>
        </a>
        <a href="dashboard.php" class="nav-link active">
            <span class="nav-icon">🔑</span>
            <span class="nav-label">Passwords</span>
        </a>
        <a href="passwordGen.php" class="nav-link">
            <span class="nav-icon">⚙️</span>
            <span class="nav-label">Generator</span>
        </a>
    </nav>

    <script src="js/dashboard.js"></script>
</body>
</html>
