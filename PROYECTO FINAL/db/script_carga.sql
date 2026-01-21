USE tienda_moto;

INSERT INTO `usuarios` (`email`, `password`, `rol`, `nombre`) VALUES
    ('anggarsma@alu.edu.gva.es', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', 'Ángel'),
    ('pepe@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2', 'Pepe');

INSERT INTO `clientes` (`nombre`, `apellidos`, `genero`, `direccion`, `codpostal`, `poblacion`, `provincia`, `password`, `email`) VALUES
    ('Alejandro', 'García López', 'H', 'Calle Mayor 15', '28001', 'Madrid', 'Madrid', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'alejandro.garcia@gmail.com'),
    ('María', 'Rodríguez Pérez', 'M', 'Avenida de la Constitución 4', '41001', 'Sevilla', 'Sevilla', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'm.rodriguez@gmail.com'),
    ('Carlos', 'Sánchez Ruiz', 'H', 'Calle Nueva 22', '08002', 'Barcelona', 'Barcelona', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'csanchez88@gmail.com'),
    ('Ana', 'Martínez Fernández', 'M', 'Plaza de España 10', '50001', 'Zaragoza', 'Zaragoza', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ana.mtnez@gmail.com'),
    ('Javier', 'Gómez Jiménez', 'H', 'Calle Real 45', '46001', 'Valencia', 'Valencia', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'javier_gomez@gmail.com'),
    ('Laura', 'Díaz Moreno', 'M', 'Calle Ancha 7', '11001', 'Cádiz', 'Cádiz', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'laura.diaz@gmail.com'),
    ('Diego', 'Álvarez Vázquez', 'H', 'Calle de la Paz 12', '36201', 'Vigo', 'Pontevedra', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'diego_alv@gmail.com'),
    ('Elena', 'Romero Santos', 'H', 'Paseo del Prado 2', '28014', 'Madrid', 'Madrid', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'elena.romero@gmail.com'),
    ('Pablo', 'Torres Castro', 'H', 'Calle Victoria 9', '29001', 'Málaga', 'Málaga', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ptorres92@gmail.com'),
    ('Sofía', 'Navarro Ortiz', 'M', 'Calle San Pablo 31', '37001', 'Salamanca', 'Salamanca', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sofia_navarro@gmail.com'),
    ('Miguel', 'Gil Marín', 'H', 'Calle Estación 5', '47001', 'Valladolid', 'Valladolid', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'miguelgil@gmail.com'),
    ('Lucía', 'Blanco Morales', 'M', 'Calle Larga 18', '11401', 'Jerez de la Frontera', 'Cádiz', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lucia.blanco@gmail.com'),
    ('Rubén', 'Serrano Muñoz', 'H', 'Calle Jardín 3', '30001', 'Murcia', 'Murcia', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'rserrano77@gmail.com'),
    ('Sara', 'Molina Delgado', 'M', 'Calle Luna 14', '03001', 'Alicante', 'Alicante', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sara_molina@gmail.com'),
    ('Hugo', 'Ramos Ortega', 'H', 'Calle Sol 22', '18001', 'Granada', 'Granada', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'hugo.ramos@gmail.com'),
    ('Paula', 'Suárez Ibáñez', 'M', 'Calle Herrería 8', '01001', 'Vitoria', 'Álava', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'paula.suarez@gmail.com'),
    ('Jorge', 'Cano Rubio', 'H', 'Avenida del Sur 101', '06001', 'Badajoz', 'Badajoz', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'jorge.cano@gmail.com'),
    ('Marta', 'Heredia Ferrer', 'M', 'Calle del Río 55', '14001', 'Córdoba', 'Córdoba', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'marta_h@gmail.com'),
    ('Adrián', 'Crespo Prieto', 'H', 'Calle Pintor 4', '33001', 'Oviedo', 'Asturias', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'adrian_crespo@gmail.com'),
    ('Irene', 'Vega Esteban', 'M', 'Calle Mayor 80', '24001', 'León', 'León', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'irene.vega@gmail.com');

INSERT INTO `productos`
(`nombre`, `precio`, `activo`, `marca`, `material`, `talla`, `medidas`, `genero`, `tipo`, `imagen`)
VALUES
-- CHAQUETAS
('Chaqueta Racing 4', 389.99, 1, 'Dainese', 'piel', 'M',
    'Brazo:62cm; Hombros:48cm; Sisa:54cm; Espalda:66cm', 'hombre', 'chaqueta', '../img/chaqueta.png'),

('Chaqueta Missile Air', 329.95, 1, 'Alpinestars', 'cordura', 'L',
    'Brazo:64cm; Hombros:50cm; Sisa:56cm; Espalda:68cm', 'hombre', 'chaqueta', '../img/chaqueta.png'),

('Chaqueta Andes V3', 299.00, 1, 'Alpinestars', 'cordura', 'XL',
    'Brazo:66cm; Hombros:52cm; Sisa:58cm; Espalda:70cm', 'unisex', 'chaqueta', '../img/chaqueta.png'),

('Chaqueta Valencia', 259.90, 1, 'Revit', 'piel', 'M',
    'Brazo:61cm; Hombros:47cm; Sisa:53cm; Espalda:65cm', 'mujer', 'chaqueta', '../img/chaqueta.png'),

-- PANTALONES
('Pantalón Racing', 249.99, 1, 'Dainese', 'piel', '48',
    'Interior:78cm; Exterior:104cm; Cadera:98cm; Cintura:84cm', 'hombre', 'pantalon', '../img/pantalon.png'),

('Pantalón Andes', 229.95, 1, 'Alpinestars', 'cordura', '50',
    'Interior:80cm; Exterior:106cm; Cadera:102cm; Cintura:88cm', 'unisex', 'pantalon', '../img/pantalon.png'),

('Pantalón Tornado', 199.90, 1, 'Revit', 'cordura', '52',
    'Interior:82cm; Exterior:108cm; Cadera:104cm; Cintura:92cm', 'hombre', 'pantalon', '../img/pantalon.png'),

('Pantalón Mujer Diva', 189.00, 1, 'Dainese', 'cordura', '42',
    'Interior:76cm; Exterior:102cm; Cadera:96cm; Cintura:80cm', 'mujer', 'pantalon', '../img/pantalon.png'),

-- MONOS
('Mono Laguna Seca 5', 1299.00, 1, 'Dainese', 'piel', '50',
    'Brazo:63cm; Hombros:49cm; Sisa:55cm; Espalda:67cm; Interior:80cm; Exterior:106cm; Cadera:100cm; Cintura:86cm',
    'hombre', 'mono', '../img/mono.png'),

('Mono Missile', 1199.95, 1, 'Alpinestars', 'piel', '52',
    'Brazo:65cm; Hombros:51cm; Sisa:57cm; Espalda:69cm; Interior:82cm; Exterior:108cm; Cadera:104cm; Cintura:90cm',
    'hombre', 'mono', '../img/mono.png'),

('Mono Mujer Atem', 1099.00, 1, 'Dainese', 'piel', '44',
    'Brazo:60cm; Hombros:46cm; Sisa:52cm; Espalda:64cm; Interior:76cm; Exterior:102cm; Cadera:94cm; Cintura:78cm',
    'mujer', 'mono', '../img/mono.png'),

('Mono Track V4', 999.00, 1, 'Revit', 'piel', '48',
    'Brazo:62cm; Hombros:48cm; Sisa:54cm; Espalda:66cm; Interior:78cm; Exterior:104cm; Cadera:98cm; Cintura:84cm',
    'unisex', 'mono', '../img/mono.png'),

-- BOTAS
('Botas Torque 3', 379.99, 1, 'Dainese', 'piel', '43',
    'Protección tibia; Suela racing', 'hombre', 'botas', '../img/botas.png'),

('Botas SMX Plus', 349.95, 1, 'Alpinestars', 'piel', '44',
    'Protecciones TPU; Slider intercambiable', 'hombre', 'botas', '../img/botas.png'),

('Botas Pioneer', 299.90, 1, 'Revit', 'cordura', '42',
    'Impermeables; Uso touring', 'unisex', 'botas', '../img/botas.png'),

('Botas Mujer Lady', 279.00, 1, 'Dainese', 'piel', '39',
    'Diseño específico femenino', 'mujer', 'botas', '../img/botas.png');
