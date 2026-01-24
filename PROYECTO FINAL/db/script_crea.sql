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