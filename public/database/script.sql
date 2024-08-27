-- Insertar datos en la tabla bodega
INSERT INTO bodega (nombre) VALUES 
('Bodega Central'),
('Bodega Norte'),
('Bodega Sur');

-- Insertar datos en la tabla sucursal, asociando a una bodega específica
INSERT INTO sucursal (nombre, bodega_id) VALUES 
('Sucursal Principal', 1),   -- Asociada a Bodega Central
('Sucursal Secundaria', 1),  -- Asociada a Bodega Central
('Sucursal Terciaria', 2);   -- Asociada a Bodega Norte

-- Insertar datos en la tabla moneda
INSERT INTO moneda (nombre) VALUES 
('PEN'),
('USD'),
('EUR'),
('MXN');

-- Insertar datos en la tabla material
INSERT INTO material (nombre) VALUES 
('Plástico'),
('Metal'),
('Madera'),
('Vidrio'),
('Textil');
