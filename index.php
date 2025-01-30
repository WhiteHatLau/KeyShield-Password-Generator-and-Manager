<?php
// Borrar sesiones anteriores si existen
session_start();

if(isset($_SESSION['user'])){
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyShield - Welcome</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="welcome-container">
        <!-- Cabecera con logo -->
        <header class="welcome-header">
            <img src="img/logo.jpeg" alt="KeyShield Logo" class="logo">
        </header>

        <!-- Contenido principal de bienvenida -->
        <div class="welcome-content">
            <h1>Welcome to KeyShield</h1>
            <p>Your password guardian.</p>
            
            <!-- Generador de Contraseñas Simple -->
            <div class="password-generator">
                <h2>Generate a Random Password</h2>
                <button onclick="generateSimplePassword()" class="primary-btn">Generate Password</button>
                <input type="text" id="simple-generated-password" readonly>
                <button onclick="copySimplePassword()" class="secondary-btn">Copy Password</button>
            </div>

            <!-- Botón para invitar a registrarse -->
            <div class="register-prompt">
                <p><a href="account.php">Sign up</a> or <a href="account.php"> log in </a> to access more features!</p>
                <a href="account.php" class="primary-btn">Register Now</a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="welcome-footer">
            <p>&copy; 2024 KeyShield. All rights reserved.</p>
            <a href="#" class="footer-link">Privacy Policy</a> | 
            <a href="#" class="footer-link">Terms of Service</a>
        </footer>
    </div>

    <script src="js/passwordGen.js"></script>
</body>
</html>
