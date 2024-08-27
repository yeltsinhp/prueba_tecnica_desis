document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        const precio = document.querySelector('#precio').value;
        if (precio <= 0) {
            alert('El precio debe ser mayor que cero.');
            event.preventDefault();
        }
    });
});