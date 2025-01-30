// Alternar entre modo claro y oscuro
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const darkModeButton = document.getElementById('dark-mode-toggle');
    if (document.body.classList.contains('dark-mode')) {
        darkModeButton.textContent = 'Light Mode';
    } else {
        darkModeButton.textContent = 'Dark Mode';
    }
}



// Función para generar una nueva contraseña
function generatePassword() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
    let password = '';
    for (let i = 0; i < 12; i++) {
        password += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('password').value = password;
}

// Simular guardar contraseña
function savePassword() {
    const modal = document.getElementById('modal');
    modal.style.display = 'flex';
}

// Cerrar modal
function closeModal() {
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

// Simular cancelar operación
function cancel() {
    window.history.back(); // Regresar a la página anterior
}
