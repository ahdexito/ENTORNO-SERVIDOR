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

INSERT INTO `productos` (`nombre`, `precio`, `activo`, `estado`, `marca`, `material`, `talla`, `medidas`, `detalles`, `genero`, `tipo`, `imagen`) VALUES
    ('Chaqueta Nickelson', 35, 1, 4, 'Nickelson', 'Cuero', 'XL', 
        'Alto de espalda: 73 cm; Ancho de espalda: 61 cm; Ancho de hombros: 52 cm; Largo de brazo: 48 cm', 
        'Forro interior sucio y algunos roces. Necesita una limpieza profesional, de ahí su bajo precio. Exterior perfecto, así también como las cremalleras. Un cosido y nueva!', 
        'hombre', 'chaqueta', '../imagenes_productos/chaqueta_Nickelson_1769159312.JPG'),
    ('Botas Forma Revenger', 55, 1, 3, 'Forma', 'Cuero', '44', '', 
        'Botas de moto Forma Revenger. Diseñadas para ofrecer protección y comodidad en la carretera. - Cierre con cremallera y velcro. - Protecciones en tobillo y espinilla. - Suela antideslizante.',
        'unisex', 'botas', '../imagenes_productos/botas_Forma_1769160295.JPG')