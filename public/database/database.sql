-- Crear la base de datos
CREATE DATABASE producto_desis;

-- Tabla bodega
CREATE TABLE bodega (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,  -- Cambiado a NOT NULL
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP
);

-- Tabla sucursal
CREATE TABLE sucursal (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,  -- Cambiado a NOT NULL
    bodega_id INT NOT NULL,        -- Añadido bodega_id para la relación con bodega
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP,
    CONSTRAINT fk_bodega FOREIGN KEY (bodega_id) REFERENCES bodega(id) ON DELETE CASCADE
);

-- Tabla moneda
CREATE TABLE moneda (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(10) NOT NULL,  -- Cambiado a NOT NULL
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP
);

-- Tabla material
CREATE TABLE material (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,  -- Cambiado a NOT NULL
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP
);

-- Tabla productos
CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,  -- Agregado UNIQUE para asegurar que sea único
    nombre VARCHAR(100) NOT NULL,
    bodega_id INT NOT NULL,
    sucursal_id INT NOT NULL,
    moneda_id INT NOT NULL,
    precio NUMERIC(10, 2) NOT NULL CHECK (precio > 0),  -- Añadido CHECK para validar que el precio sea positivo
    descripcion TEXT NOT NULL CHECK (LENGTH(descripcion) BETWEEN 10 AND 1000),  -- Añadido CHECK para validar longitud
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP,
    CONSTRAINT fk_bodega FOREIGN KEY (bodega_id) REFERENCES bodega(id) ON DELETE RESTRICT,
    CONSTRAINT fk_sucursal FOREIGN KEY (sucursal_id) REFERENCES sucursal(id) ON DELETE RESTRICT,
    CONSTRAINT fk_moneda FOREIGN KEY (moneda_id) REFERENCES moneda(id) ON DELETE RESTRICT
);

-- Tabla intermedia para la relación muchos a muchos entre productos y materiales
CREATE TABLE producto_material (
    producto_id INT NOT NULL,
    material_id INT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_at TIMESTAMP,
    PRIMARY KEY (producto_id, material_id),
    CONSTRAINT fk_producto FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
    CONSTRAINT fk_material FOREIGN KEY (material_id) REFERENCES material(id) ON DELETE CASCADE
);
