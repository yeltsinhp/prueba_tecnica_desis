document.getElementById('bodega').addEventListener('change', function() {
    const bodegaId = this.value;
    const sucursalSelect = document.getElementById('sucursal');
    sucursalSelect.innerHTML = '<option value="">Seleccione una sucursal</option>';

    if (bodegaId) {
        fetch(`index.php?action=getSucursales&bodega_id=${bodegaId}`)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                data.forEach(sucursal => {
                    const option = document.createElement('option');
                    option.value = sucursal.id;
                    option.textContent = sucursal.nombre;
                    sucursalSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las sucursales:', error));
    }
});
