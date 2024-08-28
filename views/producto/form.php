<div class="card">
    <h2>Formulario de Producto</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <script>
            alert('Producto guardado con éxito.');
        </script>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="text-danger"><?= $errors['general'] ?></div>
    <?php endif; ?>

    <form action="index.php?action=create" method="POST">
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="bodega">Bodega</label>
            <select id="bodega" name="bodega">
                <option value="">Seleccione una bodega</option>
                <?php foreach ($bodegas as $bodega): ?>
                    <option value="<?= $bodega['id'] ?>" <?= (isset($_POST['bodega']) && $_POST['bodega'] == $bodega['id']) ? 'selected' : '' ?>><?= $bodega['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select id="sucursal" name="sucursal" >
                <option value="">Seleccione una sucursal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="moneda">Moneda</label>
            <select id="moneda" name="moneda" >
                <option value="">Seleccione una moneda</option>
                <?php foreach ($monedas as $moneda): ?>
                    <option value="<?= $moneda['id'] ?>" <?= (isset($_POST['moneda']) && $_POST['moneda'] == $moneda['id']) ? 'selected' : '' ?>><?= $moneda['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>" step="0.01">
        </div>

        <label style="grid-column: span 2;">Material del Producto</label>
        <div class="checkbox-group">
            <?php if (isset($materiales) && is_array($materiales)): ?>
                <?php foreach ($materiales as $material): ?>
                    <input type="checkbox" name="material[]" value="<?= $material['id'] ?>" <?= (isset($_POST['material']) && in_array($material['id'], $_POST['material'])) ? 'checked' : '' ?>> <?= $material['nombre'] ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay materiales disponibles.</p>
            <?php endif; ?>
        </div>

        <div class="form-group" style="grid-column: span 2;">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
        </div>

        <div class="form-group-button">
            <button type="submit">Guardar Producto</button>
        </div>
    </form>
</div>