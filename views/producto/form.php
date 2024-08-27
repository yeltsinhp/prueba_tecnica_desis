<!-- form.php -->
<div class="card">
    <h2>Formulario de Producto</h2>

    <!-- Verifica si hay un mensaje de éxito -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <script>
            alert('Producto guardado con éxito.');
        </script>
    <?php endif; ?>

    <form action="index.php?action=create" method="POST">
        <!-- Código y Nombre -->
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <!-- Bodega y Sucursal -->
        <div class="form-group">
            <label for="bodega">Bodega</label>
            <select id="bodega" name="bodega" required>
                <option value="">Seleccione una bodega</option>
                <?php foreach ($bodegas as $bodega): ?>
                    <option value="<?= $bodega['id'] ?>"><?= $bodega['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select id="sucursal" name="sucursal" required>
                <option value="">Seleccione una sucursal</option>
                <!-- Las opciones de sucursal se cargarán dinámicamente -->
            </select>
        </div>

        <!-- Moneda y Precio -->
        <div class="form-group">
            <label for="moneda">Moneda</label>
            <select id="moneda" name="moneda" required>
                <option value="">Seleccione una moneda</option>
                <?php foreach ($monedas as $moneda): ?>
                    <option value="<?= $moneda['id'] ?>"><?= $moneda['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>

        <!-- Material del Producto -->
        <label style="grid-column: span 2;">Material del Producto</label>
        <div class="checkbox-group">
            <?php if (isset($materiales) && is_array($materiales)): ?>
                <?php foreach ($materiales as $material): ?>
                    <input type="checkbox" name="material[]" value="<?= $material['id'] ?>"> <?= $material['nombre'] ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay materiales disponibles.</p>
            <?php endif; ?>
        </div>

        <!-- Descripción -->
        <div class="form-group" style="grid-column: span 2;">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>

        <!-- Botón de envío -->
        <button type="submit">Guardar Producto</button>
    </form>
</div>