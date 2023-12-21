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
    ('Gavoci.Diego@example.com', MD5('password1'), 'Gavoci', 'user',, 0, 0),
    ('Masper.Mattia@example.com', MD5('password2'), 'Masper', 'admin',, 0, 0),
    ('Oberti.Fabio@example.com', MD5('password3'), 'Oberti', 'user',, 0, 0),
    ('Sonzogni.Gabriele@example.com', MD5('password4'), 'Sonzogni', 'user',, 0, 0),
    ('Todeschini.Paolo@example.com', MD5('password5'), 'Todeschini', 'admin',, 0, 0),
    ('Tasca.Lorenzo@example.com', MD5('password6'), 'Tasca', 'user',, 0, 0),
    ('Bresciani.Nicola@example.com', MD5('password7'), 'Bresciani',, 0, 0),
    ('Greco.Mattia@example.com', MD5('password8'), 'Greco', 'admin',, 0, 0),
    ('Volpi.Stefano@example.com', MD5('password9'), 'Volpi', 'user',, 0, 0),
    ('Labollita.Samuele@example.com', MD5('password10'), 'Labollita', 'user',, 0, 0),
    ('Bonacina.Giorgio@example.com', MD5('password11'), 'Bonacina', 'admin',, 0, 0),
    ('Scanzi.Filippo@example.com', MD5('password12'), 'Scanzi', 'user',, 0, 0),
    ('Arnoldi.Silvia@example.com', MD5('password13'), 'Arnoldi', 'user',, 0, 0),
    ('Arzuffi.Simone@example.com', MD5('password14'), 'Arzuffi', 'admin',, 0, 0);
```

**problema:**
organizzazione appunti scolastici

**target:**
Studenti


**libreria utlizzata:**
https://editorjs.io/

## funzionalità:
- [x] pagina di register per il sito con autenticazione utente (usando una mail)
- [x] pagina di login 
- [x] possibilità fa parte dell'admin di modificare o eliminare un utente
- [x] ricerca utenti con ajax
- [x] possibilità di modificare i propri dati da parte dell'utente
- [ ] possibilità di creare, modificare o eliminare una nota
- [ ] possibilità di creare, modificare o eliminare una categoria (due categorie non possono avere due nomi uguali)
- [ ] ricerca nota per nome
- [ ] ricerca per categoria
- [ ] condivisione delle note (facoltativo)


## relazioni:
- ogni *studente* ha più *note*
- ogni *nota* ha uno *studente*
- ogni *nota* ha una *categoria*
- ogni *categoria* ha più *note*
- ogni *studente* ha piu *categorie*
- ogni *categoria* ha uno *studente*

## ER:

![er](https://github.com/Gavoci/NoteStudio/assets/101709194/bce5f7bf-4a88-457a-9fa0-9e5fed281aa1)


## SCHEMA RELAZIONALE:
- studente(<ins>ID</ins>, mail, password, nome, cognome, user_type, n_note, n_categorie)
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

