CREATE DATABASE keyshield;
USE keyshield;

-- Tabla de usuarios
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    master_key VARCHAR(255) NOT NULL
);

-- Tabla de categorías
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);


-- Tabla de contraseñas
CREATE TABLE passwords (
    password_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    password_name VARCHAR(255) NOT NULL,
    value VARCHAR(255) NOT NULL,
    last_modify_date DATE NOT NULL,
    category_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);


-- inserción de datos predeterminados
INSERT INTO categories (category_name)
VALUES ('Work'), ('Personal'), ('Financial'), ('Other');