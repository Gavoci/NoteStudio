CREATE DATABASE IF NOT EXISTS NoteStudio;
USE NoteStudio;

-- crea tabella studente

CREATE TABLE IF NOT EXISTS studente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255),
    password VARCHAR(255),
    name VARCHAR(255),
    user_type varchar(20) DEFAULT 'user',
    `image` varchar(100), 
    n_note INT DEFAULT 0,
    n_categorie INT DEFAULT 0
);

-- crea tabella note

CREATE TABLE IF NOT EXISTS nota (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255),
    corpo TEXT,
    n_caratteri INT DEFAULT 0,
    studente_ID INT,
    categoria_ID INT,
    FOREIGN KEY (studente_ID) REFERENCES studente(ID)
);

-- crea tabella categorie

CREATE TABLE IF NOT EXISTS categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    studente_ID INT,
    FOREIGN KEY (studente_ID) REFERENCES studente(ID)
);
