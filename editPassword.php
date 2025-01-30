<?php
require_once 'includes/redirection.php';
require_once 'includes/conection.php';

// Verificar si se recibió el ID de la contraseña
if (isset($_POST['password_id']) || isset($_GET['password_id'])) {
    $password_id = isset($_POST['password_id']) ? $_POST['password_id'] : $_GET['password_id'];

    // Verificar que el ID sea válido
    if (is_numeric($password_id)) {
        $user_id = $_SESSION['user']['user_id'];
        $sql = "SELECT * FROM passwords WHERE password_id = $password_id AND user_id = $user_id";
        $result = mysqli_query($db, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $password_data = mysqli_fetch_assoc($result);
        } else {
            die("Password not found or access denied.");
        }
    } else {
        die("Invalid password ID.");
    }
} else {
    die("No password ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyShield - Edit Password</title>
    <link rel="stylesheet" href="css/passwordManager.css">
</head>
<body class="light-mode">
    <!-- Botón para cambiar a modo oscuro -->
    <button id="dark-mode-toggle" class="dark-mode-btn" onclick="toggleDarkMode()">Dark Mode</button>

    <!-- Contenedor principal -->
    <div class="password-management-container">

        <!-- Encabezado -->
        <header class="password-management-header">
            <h1>Edit Password</h1>
        </header>

        <!-- Formulario para editar contraseña -->
        <form class="password-form" action="editPassword.php" method="POST">
            <input type="hidden" name="password_id" value="<?= htmlspecialchars($password_id) ?>">

            <!-- Campo de nombre de la contraseña -->
            <label for="password_name">Name</label>
            <input type="text" id="name" name="password_name" value="<?= htmlspecialchars($password_data['password_name']) ?>" required>

            <!-- Campo de Categoría -->
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" disabled>-- Select Category --</option>
                <?php
                $categories_sql = "SELECT * FROM categories";
                $categories_result = mysqli_query($db, $categories_sql);
                if ($categories_result && mysqli_num_rows($categories_result) > 0):
                    while ($category = mysqli_fetch_assoc($categories_result)): ?>
                        <option value="<?= $category['category_id'] ?>" <?= $category['category_id'] == $password_data['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                    <?php endwhile;
                endif;
                ?>
            </select>

            <!-- Campo de Contraseña -->
            <label for="value">Password</label>
            <div class="password-input-container">
                <input type="text" id="password" name="value" value="<?= htmlspecialchars($password_data['value']) ?>" required>
            </div>

            <!-- Botón para generar nueva contraseña -->
            <button type="button" class="generate-password-btn" onclick="generatePassword()">Generate New Password</button>

            <!-- Botones de acción -->
            <div class="form-buttons">
                <button type="submit" class="save-btn" name="update_password">Save</button>
                <button type="button" class="cancel-btn" onclick="cancel()">Cancel</button>
            </div>
        </form>

    </div>

    <!-- Modal para confirmación de guardado -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <p>Password updated successfully!</p>
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

<?php
require_once 'includes/conection.php';

if (isset($_POST['update_password'])) {
    $password_id = $_POST['password_id'];
    $password_name = $_POST['password_name'];
    $category_id = $_POST['category'];
    $new_password = $_POST['value'];

    // Validar los campos
    if (!empty($password_name) && !empty($new_password)) {
        $sql = "UPDATE passwords 
                SET password_name = '$password_name', category_id = '$category_id', value = '$new_password' 
                WHERE password_id = $password_id";

        $result = mysqli_query($db, $sql);

        if ($result) {
            header('Location: dashboard.php?msg=Password updated successfully');
        } else {
            echo "Error updating password.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
