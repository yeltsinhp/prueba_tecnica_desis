-- Insertar datos en la tabla bodega
INSERT INTO bodega (nombre) VALUES 
('Bodega Central'),
('Bodega Norte'),
('Bodega Sur');

-- Insertar datos en la tabla sucursal, asociando a una bodega específica
INSERT INTO sucursal (nombre, bodega_id) VALUES 
('Sucursal Principal', 1),  
('Sucursal Secundaria', 1),  
('Sucursal Terciaria', 2); 

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
