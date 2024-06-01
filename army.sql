CREATE DATABASE Army;
USE Army;

DROP TABLE register;
CREATE TABLE register(
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
	username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL
) ENGINE = InnoDB;
                     
SELECT * FROM register;

DROP TABLE soldier;
CREATE TABLE soldier(
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (name) REFERENCES logINFO(name),
    surname VARCHAR(255) NOT NULL,
    FOREIGN KEY (surname) REFERENCES logINFO(surname)
    date_of_birth DATETIME NOT NULL,
    height FLOAT NOT NULL,
    weight FLOAT NOT NULL,
    blood_type VARCHAR(255) NOT NULL,
    aspiration VARCHAR(255) NOT NULL,
    degree VARCHAR(255) NOT NULL, 
) ENGINE = InnoDB;

DROP TABLE soldier;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

INSERT INTO products (name, price) VALUES
('Prodotto 1', 10.00),
('Prodotto 2', 20.00),
('Prodotto 3', 30.00);

SELECT * FROM register;