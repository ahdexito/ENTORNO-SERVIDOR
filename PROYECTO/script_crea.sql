DROP DATABASE IF EXISTS tienda_moto;

CREATE DATABASE tienda_moto;

USE tienda_moto;

CREATE TABLE cliente(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    genero CHAR(1) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    codpostal CHAR(5) NOT NULL,
    poblacion VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    password CHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE KEY,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE usuario(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE KEY,
    password CHAR(40) NOT NULL,
    rol TINYINT(4) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE producto(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(8,2) NOT NULL,
    marca VARCHAR(50),
    comentarios VARCHAR(150),
    material VARCHAR(50) DEFAULT 'piel',
    categoria ENUM('hombre', 'mujer', 'unisex') NOT NULL DEFAULT 'hombre',
    tipo ENUM('chaqueta', 'pantalon', 'mono', 'botas', 'guantes') NOT NULL
);

CREATE TABLE chaqueta(
    producto_id INT PRIMARY KEY,
    talla VARCHAR(5) NOT NULL,
    hombros INT NOT NULL,
    sisa INT NOT NULL,
    espalda INT NOT NULL,
    brazo INT NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE pantalon(
    producto_id INT PRIMARY KEY,
    talla VARCHAR(5) NOT NULL,
    cintura INT NOT NULL,
    cadera INT NOT NULL,
    largo_interior INT NOT NULL,
    largo_exterior INT NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE mono(
    producto_id INT PRIMARY KEY,
    talla VARCHAR(5) NOT NULL,
    hombros INT NOT NULL,
    sisa INT NOT NULL,
    espalda INT NOT NULL,
    brazo INT NOT NULL,
    cintura INT NOT NULL,
    cadera INT NOT NULL,
    largo_interior INT NOT NULL,
    largo_exterior INT NOT NULL,
    largo_total INT NOT NULL
);

CREATE TABLE botas(
    producto_id INT PRIMARY KEY,
    talla INT NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE guantes(
    producto_id INT PRIMARY KEY,
    talla VARCHAR(5) NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);

CREATE TABLE pedido(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'pagado', 'enviado', 'cancelado') NOT NULL,
    total DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id)
);

CREATE TABLE linea_pedido(
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL UNIQUE,
    precio DECIMAL(8, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedido(id),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);