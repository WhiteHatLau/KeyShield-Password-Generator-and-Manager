// Función para generar una contraseña simple
function generateSimplePassword() {
    const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    let password = '';
    for (let i = 0; i < 10; i++) {
        password += characters[Math.floor(Math.random() * characters.length)];
    }
    document.getElementById('simple-generated-password').value = password;
}

// Función para copiar la contraseña generada al portapapeles
function copySimplePassword() {
    const password = document.getElementById('simple-generated-password');
    password.select();
    document.execCommand('copy');
    alert('Password copied to clipboard!');
}









// Función para alternar entre modo claro y oscuro
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const darkModeButton = document.getElementById('dark-mode-toggle');
    if (document.body.classList.contains('dark-mode')) {
        darkModeButton.textContent = 'Light Mode';
    } else {
        darkModeButton.textContent = 'Dark Mode';
    }
}

// Función para actualizar la longitud de la contraseña
function updateLength(value) {
    document.getElementById('password-length-display').textContent = value;
}

// Función para generar una contraseña
function generatePassword() {
    const length = document.getElementById('password-length').value;
    const includeNumbers = document.getElementById('include-numbers').checked;
    const includeSymbols = document.getElementById('include-symbols').checked;
    const includeUppercase = document.getElementById('include-uppercase').checked;
    
    let characters = 'abcdefghijklmnopqrstuvwxyz';
    if (includeNumbers) characters += '0123456789';
    if (includeSymbols) characters += '!@#$%^&*()';
    if (includeUppercase) characters += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    let password = '';
    for (let i = 0; i < length; i++) {
        password += characters[Math.floor(Math.random() * characters.length)];
    }

    document.getElementById('generated-password').value = password;
    updateStrength(password);
}

// Función para copiar la contraseña
function copyPassword() {
    const password = document.getElementById('generated-password');
    password.select();
    document.execCommand('copy');
    alert('Password copied to clipboard!');
}

// Función para actualizar la barra de fortaleza de la contraseña
function updateStrength(password) {
    const strengthIndicator = document.getElementById('strength-indicator');
    let strength = 0;

    if (password.length >= 12) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[!@#$%^&*()]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;

    const percentage = (strength / 4) * 100;
    strengthIndicator.style.width = `${percentage}%`;

    if (strength === 4) {
        strengthIndicator.style.backgroundColor = 'green';
    } else if (strength === 3) {
        strengthIndicator.style.backgroundColor = 'yellow';
    } else {
        strengthIndicator.style.backgroundColor = 'red';
    }
}
