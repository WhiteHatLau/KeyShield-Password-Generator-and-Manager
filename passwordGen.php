<?php
require_once 'includes/redirection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyShield - Password Generator</title>
    <link rel="stylesheet" href="css/passwordGen.css">
</head>
<body class="light-mode">
    <!-- Botón de modo oscuro -->
    <button id="dark-mode-toggle" class="dark-mode-btn" onclick="toggleDarkMode()">Dark Mode</button>

    <!-- Contenedor principal -->
    <div class="generator-container">

        <!-- Encabezado -->
        <header class="generator-header">
            <h1>Password Generator</h1>
        </header>

        <!-- Sección de controles -->
        <section class="generator-controls">
            <label for="password-length">Password Length</label>
            <input type="range" id="password-length" min="6" max="32" value="12" oninput="updateLength(this.value)">
            <span id="password-length-display">12</span>

            <div class="options">
                <label>
                    <input type="checkbox" id="include-numbers" checked>
                    Include Numbers
                </label>
                <label>
                    <input type="checkbox" id="include-symbols">
                    Include Symbols
                </label>
                <label>
                    <input type="checkbox" id="include-uppercase" checked>
                    Include Uppercase
                </label>
            </div>
        </section>

        <!-- Sección de salida de la contraseña -->
        <section class="password-output">
            <form action="passwordManager.php?source=passwordGen" method="POST">
            <label for="generated-password">Generated Password</label>
            <input type="text" id="generated-password" name="generated-password" readonly>
            <button onclick="copyPassword()">📋 Copy</button>
        <!-- Guardar contraseña, redirecciona a passwordManager -->
        <button type="submit" class="save-btn">Save Password</button>
            </form>
        </section>

        <!-- Botón para generar contraseña -->
        <button class="generate-btn" onclick="generatePassword()">Generate Password</button>

        <!-- Barra de fortaleza de la contraseña -->
        <div class="password-strength">
            <label>Password Strength</label>
            <div id="strength-bar">
                <div id="strength-indicator"></div>
            </div>
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

    <script src="js/passwordGen.js"></script>
</body>
</html>
