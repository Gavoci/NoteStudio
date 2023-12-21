# NoteStudio

**prerequisito:**
avere XAMP sulla propria macchina, con dentro htdocs la cartella di NoteStudio
```
http://localhost/NoteStudio-main/login.php
```
```
http://localhost/phpmyadmin/
```
## MODELLO FISICO:

```sql
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


```

**popolare il database con degli utenti:**
```
INSERT INTO studente (email, password, name, user_type, `image`, n_note, n_categorie)
VALUES
    ('john.doe@example.com', MD5('password1'), 'John Doe', 'user', 'john_doe.jpg', 0, 0),
    ('jane.smith@example.com', MD5('password2'), 'Jane Smith', 'admin', 'jane_smith.jpg', 0, 0),
    ('michael.jones@example.com', MD5('password3'), 'Michael Jones', 'user', 'michael_jones.jpg', 0, 0),
    ('emily.brown@example.com', MD5('password4'), 'Emily Brown', 'user', 'emily_brown.jpg', 0, 0),
    ('david.white@example.com', MD5('password5'), 'David White', 'admin', 'david_white.jpg', 0, 0),
    ('susan.miller@example.com', MD5('password6'), 'Susan Miller', 'user', 'susan_miller.jpg', 0, 0),
    ('brian.adams@example.com', MD5('password7'), 'Brian Adams', 'user', 'brian_adams.jpg', 0, 0),
    ('olivia.jenkins@example.com', MD5('password8'), 'Olivia Jenkins', 'admin', 'olivia_jenkins.jpg', 0, 0),
    ('ryan.anderson@example.com', MD5('password9'), 'Ryan Anderson', 'user', 'ryan_anderson.jpg', 0, 0),
    ('amber.wilson@example.com', MD5('password10'), 'Amber Wilson', 'user', 'amber_wilson.jpg', 0, 0),
    ('chris.smith@example.com', MD5('password11'), 'Chris Smith', 'admin', 'chris_smith.jpg', 0, 0),
    ('lisa.baker@example.com', MD5('password12'), 'Lisa Baker', 'user', 'lisa_baker.jpg', 0, 0),
    ('kevin.jackson@example.com', MD5('password13'), 'Kevin Jackson', 'user', 'kevin_jackson.jpg', 0, 0),
    ('natalie.martin@example.com', MD5('password14'), 'Natalie Martin', 'admin', 'natalie_martin.jpg', 0, 0),
    ('daniel.hill@example.com', MD5('password15'), 'Daniel Hill', 'user', 'daniel_hill.jpg', 0, 0);
```

**problema:**
organizzazione appunti scolastici

**target:**
Studenti


**libreria utlizzata:**
https://editorjs.io/

## funzionalità:
 [] possibilità di creare, modificare o eliminare una nota
 - possibilità di creare, modificare o eliminare una categoria (due categorie non possono avere due nomi uguali)
 - pagina di login per il sito con autenticazione utente (usando una mail)
 - ricerca nota per nome
 - ricerca per categoria
 - condivisione delle note (facoltativo)


## relazioni:
- ogni *studente* ha più *note*
- ogni *nota* ha uno *studente*
- ogni *nota* ha una *categoria*
- ogni *categoria* ha più *note*
- ogni *studente* ha piu *categorie*
- ogni *categoria* ha uno *studente*

## ER:

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/ce9fc942-df3b-4401-b78e-49fbb9e58b53)


## SCHEMA RELAZIONALE:
- studente(<ins>ID</ins>, mail, password, nome, cognome, n_note, n_categorie)
- nota(<ins>ID</ins>, titolo, corpo, n_caratteri, studente_ID, categoria_ID)
- categoria(<ins>ID</ins>, nome, studente_ID)


## mockup:

<ins>inserimento blocco:</ins>
![aggiunta blocco](https://github.com/Gavoci/NoteStudio/assets/101709194/59a2a8eb-24d0-4b6b-a943-bc6d89bb0ac3)



<ins>modifica testo:</ins>
![modifica testo](https://github.com/Gavoci/NoteStudio/assets/101709194/010fa7d1-d51c-4be5-ba3b-ea903e81e8ab)



<ins>sign in:</ins>
![registrazione](https://github.com/Gavoci/NoteStudio/assets/101709194/323ee2a5-4133-48c3-9a53-00fb99d4c304)


<ins>login:</ins>
![Senza titolo](https://github.com/Gavoci/NoteStudio/assets/101709194/7e28dd47-d370-45a8-bfc9-a22a7ff2064c)


<ins>user page:</ins>
![Screenshot 2023-10-30 125335](https://github.com/Gavoci/NoteStudio/assets/101709194/6f2acb31-3618-400e-aac3-d34d24661cc6)

<ins>schermata con categorie e note create:</ins>
![schermataConCategorie](https://github.com/Gavoci/NoteStudio/assets/101709194/7e50ea87-5f8f-4736-bea1-1d3680d46f24)

<ins>back-end:</ins>
![backend](https://github.com/Gavoci/NoteStudio/assets/101709194/8ad991e6-567f-46a5-96c9-6d09ce606467)

