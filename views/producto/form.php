<div class="card">
    <h2>Formulario de Producto</h2>
    <form action="index.php?action=create" method="POST">
        <!-- Primera fila: Código y Nombre -->
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" id="codigo" name="codigo" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <!-- Segunda fila: Bodega y Sucursal -->
        <div class="form-group">
            <label for="bodega">Bodega</label>
            <select id="bodega" name="bodega">
                <?php foreach($bodegas as $bodega): ?>
                    <option value="<?= $bodega['id'] ?>"><?= $bodega['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select id="sucursal" name="sucursal">
                <?php foreach($sucursales as $sucursal): ?>
                    <option value="<?= $sucursal['id'] ?>"><?= $sucursal['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tercera fila: Moneda y Precio -->
        <div class="form-group">
            <label for="moneda">Moneda</label>
            <select id="moneda" name="moneda">
                <?php foreach($monedas as $moneda): ?>
                    <option value="<?= $moneda['id'] ?>"><?= $moneda['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" required>
        </div>

        <!-- Material del Producto en una fila -->
        <label style="grid-column: span 2;">Material del Producto</label>
        <div class="checkbox-group">
            <?php foreach($materiales as $material): ?>
                <input type="checkbox" name="material[]" value="<?= $material['id'] ?>"> <?= $material['nombre'] ?>
            <?php endforeach; ?>
        </div>

        <!-- Descripción en una fila completa -->
        <div class="form-group" style="grid-column: span 2;">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </div>

        <!-- Botón de envío en una fila completa -->
        <button type="submit">Guardar Producto</button>
    </form>
</div>
