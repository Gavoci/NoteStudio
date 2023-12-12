CREATE DATABASE IF NOT EXISTS NoteStudio;
USE NoteStudio;

-- crea tabella studente

CREATE TABLE IF NOT EXISTS studente (
    ID INT PRIMARY KEY,
    mail VARCHAR(255),
    password VARCHAR(255),
    nome VARCHAR(255),
    cognome VARCHAR(255),
    n_note INT,
    n_categorie INT
);

-- crea tabella note

CREATE TABLE IF NOT EXISTS nota (
    ID INT PRIMARY KEY,
    titolo VARCHAR(255),
    corpo TEXT,
    n_caratteri INT,
    studente_ID INT,
    categoria_ID INT,
    FOREIGN KEY (studente_ID) REFERENCES studente(ID)
);

-- crea tabella categorie

CREATE TABLE IF NOT EXISTS categoria (
    ID INT PRIMARY KEY,
    nome VARCHAR(255),
    studente_ID INT,
    FOREIGN KEY (studente_ID) REFERENCES studente(ID)
);
)