# NoteStudio

**prerequisito:**
avere XAMP sulla propria macchina, con dentro htdocs la cartella di NoteStudio
```
http://localhost/NoteStudio-main/index.php
```
```
http://localhost/phpmyadmin/
```
## MODELLO FISICO:

```sql
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL,
  `note_user` int(10) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note_cat` int(10) NOT NULL,
  `note_tags` varchar(255) NOT NULL,
  `note_desc` longtext NOT NULL,
  `note_image` varchar(255) DEFAULT NULL,
  `note_privacy` int(10) NOT NULL,
  `notes_status` int(10) NOT NULL,
  `note_views` int(10) NOT NULL,
  `note_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_role` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_position` varchar(255) NOT NULL,
  `user_company` varchar(255) NOT NULL,
  `user_companyStart` varchar(255) NOT NULL,
  `user_companyEnd` varchar(255) NOT NULL,
  `user_primary` varchar(255) NOT NULL,
  `user_secondary` varchar(255) NOT NULL,
  `user_degreeName` varchar(255) NOT NULL,
  `user_graduationYear` varchar(255) NOT NULL,
  `user_location` varchar(255) NOT NULL,
  `user_bio` text NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_joined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_phone` (`user_phone`);

ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
- [X] possibilità di creare, modificare o eliminare una nota
- [X] possibilità di creare, modificare o eliminare una categoria (due categorie non possono avere due nomi uguali)
- [X] ricerca nota per nome
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

