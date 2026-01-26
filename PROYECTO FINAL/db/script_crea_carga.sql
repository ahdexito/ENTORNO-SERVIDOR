DROP DATABASE IF EXISTS tienda_moto;

CREATE DATABASE tienda_moto;

USE tienda_moto;

CREATE TABLE clientes(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    genero ENUM('H', 'M', 'O') NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    codpostal CHAR(5) NOT NULL,
    poblacion VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    password CHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE KEY,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE usuarios(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE KEY,
    password CHAR(40) NOT NULL,
    rol TINYINT(1) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE productos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(8,2) NOT NULL,
    activo TINYINT(1) NOT NULL,
    estado TINYINT(1) NOT NULL,
    marca VARCHAR(50),
    material VARCHAR(50) NOT NULL,
    talla VARCHAR(10),
    medidas VARCHAR(500),
    detalles VARCHAR(1000),
    genero ENUM('hombre', 'mujer', 'unisex') NOT NULL,
    tipo ENUM('chaqueta', 'pantalon', 'mono', 'botas', 'guantes') NOT NULL,
    imagen VARCHAR(200) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE pedidos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'pagado', 'enviado', 'cancelado') NOT NULL,
    total DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE linea_pedido(
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL UNIQUE,
    precio DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

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
    ('Chaqueta Nickelson', 35, 1, 4, 'Nickelson', 'Cuero', 'XL', 'Alto de espalda: 73 cm; Ancho de espalda: 61 cm; Ancho de hombros: 52 cm; Largo de brazo: 48 cm', 'Forro interior sucio y algunos roces. Necesita una limpieza profesional, de ahí su bajo precio. Exterior perfecto, así también como las cremalleras. Un cosido y nueva!', 'hombre', 'chaqueta', '../imagenes_productos/chaqueta_Nickelson_1769159312.JPG'),
    ('Botas Forma Revenger', 55, 1, 3, 'Forma', 'Cuero', '44', 'Suela: 31 cm; Altura total: 30 cm', 'Botas de moto Forma Revenger. Diseñadas para ofrecer protección y comodidad en la carretera. - Cierre con cremallera y velcro. - Protecciones en tobillo y espinilla. - Suela antideslizante.', 'unisex', 'botas', '../imagenes_productos/botas_Forma_1769160295.JPG'),
    ('Pantalón Skinz', 20, 1, 3, 'Skinz', 'Cuero', '38', 'Ancho de cintura: 38 cm; Ancho de cadera: 50cm; Largo exterior: 103 cm; Largo interior: 76cm', 'Fácil arreglo de bajos, solo cortar.', 'mujer', 'pantalon', '../imagenes_productos/pantalon_Skinz_1769168993.JPG'),
    ('Mono FLM', 230, 1, 2, 'FLM', 'Cuero', '50 / 56', 'PANTALÓN: Ancho de cintura: 42 cm; Ancho de cadera: 49 cm; Largo exterior: 108 cm; Largo interior: 82 cm; CHAQUETA: Alto de espalda: 60 cm; Ancho de espalda: 54 cm; Ancho de hombros: 51 cm; Largo de brazo: 49 cm.', 'Está prácticamente nuevo, sin alguna marca de uso. Una autentica ganga! Costó 500€ en tienda. La chaqueta es talla L y el pantalón talla M.', 'hombre', 'mono', '../imagenes_productos/mono_FLM_1769170944.JPG'),
    ('Chaqueta REV IT Cayenne Pro', 125, 1, 2, 'REV IT', 'Cordura', 'S', 'Alto de espalda: 70 cm; Ancho de espalda: 54 cm; Ancho de hombros: 46 cm; Largo de brazo: 50 cm', 'Ajustes de cintura y brazo. Cordura 600D. Todas las protecciones: codos, espalda y hombros. Bolsillos exteriores. DOBLE forro extraíble,. Enganche de pantalón. Almena ancha. Entradas aire.', 'hombre', 'chaqueta', '../imagenes_productos/chaqueta_REV IT_21_20260125152100.jpg'),
    ('Chaqueta Hein-Gericke Pro Sports', 75, 1, 2, 'Hein-Gericke', 'Cordura', '52', 'Alto de espalda: 72 cm; Ancho de espalda: 58 cm; Ancho de hombros: 50 cm; Largo de brazo: 52 cm', 'Chaqueta deportiva de alta resistencia. Incluye protecciones homologadas y forro térmico desmontable. Ideal para entretiempo.', 'hombre', 'chaqueta', '../imagenes_productos/chaqueta_Hein-Gericke_20260125152714.jpg'),
    ('Botas Daytona Traveller GTX', 75, 1, 3, 'Daytona', 'Cuero', '43', 'Suela: 30 cm; Altura total: 32 cm', 'Membrana Gore-Tex impermeable y transpirable. Muy cómodas para viajes largos. Signos normales de uso en la zona del cambio.', 'unisex', 'botas', '../imagenes_productos/botas_Daytona_20260125153048.jpg'),
    ('Chaqueta James Harvest', 30, 1, 2, 'James Harvest', 'Cordura', 'XL', 'Alto de espalda: 75 cm; Ancho de espalda: 62 cm; Ancho de hombros: 54 cm; Largo de brazo: 54 cm', 'Corte amplio y cómodo. Material resistente a la abrasión. Varios bolsillos internos para documentos.', 'hombre', 'chaqueta', '../imagenes_productos/chaqueta_James Harvest_20260125153320.jpg'),
    ('Pantalón Leatherwear', 35, 1, 3, 'Leatherwear', 'Cuero', '30', 'Ancho de cintura: 40 cm; Largo exterior: 105 cm', 'Pantalón clásico de cuero tipo custom. Cuero grueso de buena calidad. Sin protecciones rígidas.', 'unisex', 'pantalon', '../imagenes_productos/pantalon_Leatherwear_20260125153556.jpg'),
    ('Chaqueta Fast Way', 55, 1, 2, 'Fast Way', 'Cordura', '40', 'Alto de espalda: 65 cm; Ancho de espalda: 48 cm; Largo de brazo: 48 cm', 'Diseño entallado para mujer. Reflectantes para visibilidad nocturna. Protecciones en codos y hombros incluidas.', 'mujer', 'chaqueta', '../imagenes_productos/chaqueta_Fast Way_20260125154051.jpg'),
    ('Pantalón Dainese', 90, 1, 2, 'Dainsese', 'Cuero', '42', 'Ancho de cintura: 42 cm; Largo interior: 78 cm', 'Pantalón técnico con deslizaderas (sliders) incluidas. Cremallera de unión a chaqueta universal de la marca.', 'unisex', 'pantalon', '../imagenes_productos/i6233646003.jpg'),
    ('Chaqueta Modeka', 55, 1, 2, 'Modeka', 'Cordura', '54', 'Alto de espalda: 74 cm; Ancho de espalda: 60 cm; Ancho de hombros: 52 cm', 'Marca alemana de calidad. Muy ventilada para verano pero con forro para lluvia. Estado impecable.', 'hombre', 'chaqueta', '../imagenes_productos/i6204079013.jpg'),
    ('Chaqueta Dainese', 110, 1, 2, 'Dainese', 'Cordura', '46', 'Alto de espalda: 64 cm; Ancho de espalda: 50 cm; Ancho de hombros: 44 cm', 'Chaqueta de gama alta. Muy ligera y segura. Protecciones compuestas desmontables. Color negro mate.', 'mujer', 'chaqueta', '../imagenes_productos/i6202107778.jpg'),
    ('Botas Vanucci', 55, 1, 2, 'Vanucci', 'Cuero', '41', 'Altura: 28 cm; Suela: 28.5 cm', 'Estilo racing/sport. Refuerzo en el talón y puntera reforzada. Cierre micrométrico muy preciso.', 'unisex', 'botas', '../imagenes_productos/i6185914006.jpg'),
    ('Chaqueta Triumph', 150, 1, 2, 'Triumph', 'Cordura', 'XS', 'Alto de espalda: 62 cm; Ancho de espalda: 46 cm; Ancho de hombros: 42 cm', 'Producto oficial Triumph. Estilo vintage/adventure. Muy difícil de encontrar en esta talla. Como nueva.', 'hombre', 'chaqueta', '../imagenes_productos/i5510436977.jpg'),
    ('Chaqueta Ruka Gore-Tex', 180, 1, 3, 'Rukka', 'Cordura', 'L 42', 'Alto de espalda: 72 cm; Ancho de espalda: 56 cm; Ancho de hombros: 48 cm', 'Calidad Rukka garantizada. Gore-Tex laminado que no absorbe agua. Una de las mejores marcas del mercado.', 'hombre', 'chaqueta', '../imagenes_productos/i3422200483.jpg'),
    ('Botas Firefox', 40, 1, 3, 'Firefox', 'Cordura', '44', 'Suela: 31 cm; Altura total: 18 cm', 'Botas cortas tipo botín. Ideales para uso urbano diario. Refuerzo en la zona del pedal de cambio.', 'unisex', 'botas', '../imagenes_productos/i6108977908.jpg'),
    ('Mono Prexport', 110, 1, 3, 'Prexport', 'Cuero', '50', 'Ancho de hombros: 50 cm; Cintura: 44 cm; Largo pierna: 75 cm', 'Mono de una pieza. Cuero con zonas elásticas para mayor movilidad. Ideal para iniciación en circuito.', 'hombre', 'mono', '../imagenes_productos/i5358916842.jpg'),
    ('Pantalón Café Racer', 45, 1, 2, 'Café Racer', 'Cordura', 'S', 'Ancho de cintura: 38 cm; Largo: 100 cm', 'Estilo urbano discreto. Parece un pantalón normal pero con protecciones internas y forro de kevlar.', 'unisex', 'pantalon', '../imagenes_productos/i5333173923.jpg'),
    ('Botas Probiker', 55, 1, 2, 'Probiker', 'Cuero', '41', 'Altura: 25 cm; Suela: 28.5 cm', 'Botas de caña media. Muy resistentes al agua. Suela rígida para mayor seguridad en caso de caída.', 'unisex', 'botas', '../imagenes_productos/i5371487714.jpg'),
    ('Mono Hein-Gericke', 110, 1, 3, 'Hein-Gericke', 'Cuero', '58 / 52', 'CHAQUETA T-58: Espalda 75 cm, Hombros 54 cm; PANTALÓN T-52: Cintura 46 cm, Largo 104 cm', 'Conjunto de dos piezas unido por cremallera. Tallas diferentes para complexión robusta de espalda.', 'hombre', 'mono', '../imagenes_productos/i5358941566.jpg'),
    ('Chaqueta FLM Sport', 60, 1, 3, 'FLM', 'Cuero', '50', 'Alto de espalda: 68 cm; Ancho de espalda: 56 cm; Ancho de hombros: 48 cm; Largo de brazo: 50 cm', 'Chaqueta deportiva de cuero. Desgaste estético mínimo. Cremalleras en perfecto estado.', 'hombre', 'chaqueta', '../imagenes_productos/i5345814304.jpg'),
    ('Chaqueta Hein-Gericke', 65, 1, 3, 'Hein-Gericke', 'Cuero', '44', 'Alto de espalda: 62 cm; Ancho de espalda: 50 cm; Ancho de hombros: 44 cm; Largo de brazo: 48 cm', 'Corte femenino clásico. Cuero de excelente calidad, muy suave al tacto. Protecciones ligeras.', 'mujer', 'chaqueta', '../imagenes_productos/i5310175137.jpg'),
    ('Chaqueta Gipsy', 55, 1, 3, 'Gipsy', 'Cuero', 'S', 'Alto de espalda: 60 cm; Ancho de espalda: 46 cm; Ancho de hombros: 42 cm; Largo de brazo: 46 cm', 'Estilo casual/moto. Perfecta para ciudad. No incluye protecciones rígidas de serie.', 'mujer', 'chaqueta', '../imagenes_productos/i4648239709.jpg'),
    ('Chaqueta Firefox', 40, 1, 2, 'Firefox', 'Cordura', 'S', 'Alto de espalda: 68 cm; Ancho de espalda: 52 cm; Ancho de hombros: 46 cm; Largo de brazo: 49 cm', 'Chaqueta textil básica muy funcional. Forro térmico incluido. Ideal para principiantes.', 'hombre', 'chaqueta', '../imagenes_productos/i3156551020.jpg');