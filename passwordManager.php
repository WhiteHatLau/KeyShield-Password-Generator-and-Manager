<?php
require_once 'includes/redirection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyShield - Manage Password</title>
    <link rel="stylesheet" href="css/passwordManager.css">
</head>
<body class="light-mode">
    <!-- Botón para cambiar a modo oscuro -->
    <button id="dark-mode-toggle" class="dark-mode-btn" onclick="toggleDarkMode()">Dark Mode</button>

    <!-- Contenedor principal -->
    <div class="password-management-container">

        <!-- Encabezado -->
        <header class="password-management-header">
            <h1>Add/Edit Password</h1>
        </header>

        <!-- Formulario para agregar o editar contraseña -->
        <form class="password-form" action="savePassword.php" method="POST">
            <!-- Campo de nombre de la contraseña -->
            <label for="password_name">Name</label>
            <input type="text" id="name" name="password_name" placeholder="e.g. Personal Email" required>

            <!-- Campo de Categoría -->
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" selected disabled>-- Select Category --</option> <!-- Opción en blanco por defecto -->
                <option value="1">Work</option>
                <option value="2">Personal</option>
                <option value="3">Financial</option>
                <option value="4">Other</option>
            </select>

            <!-- Campo de Contraseña -->

            <!-- Comprueba si se viene redirigido desde passwordGen.php mirando el parámetro de la URL -->
            <?php
            $generatedPassword = '';
            if (isset($_GET['source']) && $_GET['source'] === 'passwordGen' && isset($_POST['generated-password'])) {
                $generatedPassword = $_POST['generated-password'];
            }
            ?>



            <label for="value">Password</label>
            <div class="password-input-container">
                <input type="text" id="password" name="value" placeholder="Enter your password" value="<?php echo htmlspecialchars($generatedPassword); ?>"required> <!-- Si se redirige desde passwordGen.php, se rellena automáticamente con la contraseña generada allí -->

            </div>

            <!-- Botón para generar nueva contraseña -->
            <button type="button" class="generate-password-btn" onclick="generatePassword()">Generate New Password</button>


            <!-- Botones de acción -->
            <div class="form-buttons">
                <button type="submit" class="save-btn">Save</button>
                <button type="button" class="cancel-btn" onclick="cancel()">Cancel</button>
            </div>
        </form>

    </div>

    <!-- Modal para confirmación de guardado -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <p>Password saved successfully!</p>
            <button onclick="closeModal()">OK</button>
        </div>
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

    <script src="js/passwordManager.js"></script>
</body>
</html>
