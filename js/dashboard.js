
// Filtro de búsqueda
document.getElementById("search").addEventListener("input", function() {
    let searchQuery = this.value.toLowerCase();
    let passwordItems = document.querySelectorAll(".password-item");

    passwordItems.forEach(function(item) {
        let title = item.querySelector(".password-title").textContent.toLowerCase();
        if (title.includes(searchQuery)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
});




    // Selecciona el botón de modo oscuro y el body
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    // Escucha el evento de clic en el botón
    toggleButton.addEventListener('click', function() {
        // Alterna la clase 'dark-mode' en el body
        body.classList.toggle('dark-mode');
        
        // Cambia el texto del botón según el modo
        if (body.classList.contains('dark-mode')) {
            toggleButton.textContent = 'Light Mode';
        } else {
            toggleButton.textContent = 'Dark Mode';
        }
    });

