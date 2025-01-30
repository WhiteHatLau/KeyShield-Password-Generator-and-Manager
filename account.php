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
    <title>KeyShield - Sign Up / Login</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    <div class="auth-container">
        <!-- Cabecera con logo -->
        <header class="auth-header">
            <img src="img/logo.jpeg" alt="KeyShield Logo" class="logo">
        </header>

        <!-- Contenedor de formularios en paralelo -->
        <div class="forms-wrapper">
            <!-- Formulario de Iniciar Sesión -->
            <div class="form-container">
                <h2>Login</h2>


                <form action="login.php" method="POST">
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label for="master_key">Password:</label>
                        <input type="password" name="master_key" id="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="primary-btn">Login</button>
                </form>
            </div>

            <!-- Formulario de Registro -->
            <div class="form-container">
                <h2>Sign Up</h2>
                <form action="register.php" method="POST">
                    <div class="input-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" placeholder="Choose a username" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email-signup" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label for="master_key">Password:</label>
                        <input type="password" name="master_key" id="master_key" placeholder="Create a password" required>
                    </div>

                    <button type="submit" class="primary-btn">Sign Up</button>
                </form>
            </div>
        </div>

        <!-- Footer siempre en la parte inferior -->
        <footer class="auth-footer">
            <p>&copy; 2024 KeyShield. All rights reserved.</p>
            <a href="#" class="footer-link">Privacy Policy</a> | 
            <a href="#" class="footer-link">Terms of Service</a>
        </footer>
    </div>
</body>
</html>