# NoteStudio

**comando:**
```
docker run --name myXampp -p 41061:22 -p 41062:80 -d -v /workspaces/NoteStudio:/www tomsik68/xampp:8
```
**diventare admin:**
modificare l'user_role da 0 a 1
```
## MODELLO FISICO:

```sql
CREATE DATABASE IF NOT EXISTS NoteStudio;
USE NoteStudio;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tenants` (
  `tenant_code` varchar(5) NOT NULL,
  `tenant_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_role` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_gender` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_joined` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_phone` (`user_phone`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_date` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL AUTO_INCREMENT,
  `note_user` int(10) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note_tags` varchar(255) NOT NULL,
  `note_desc` longtext NOT NULL,
  `notes_status` int(10) NOT NULL,
  `note_views` int(10) NOT NULL,
  `note_cat` int(10) NOT NULL,
  `note_date` datetime NOT NULL DEFAULT current_timestamp(),
  `tenant_code` varchar(5) NOT NULL,
  PRIMARY KEY (`note_id`),
  FOREIGN KEY (`note_user`) REFERENCES `users`(`user_id`),
  FOREIGN KEY (`note_cat`) REFERENCES `categories`(`cat_id`),
  FOREIGN KEY (`tenant_code`) REFERENCES `tenants`(`tenant_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

```
## riempi database

```sql
-- Inserimento del tenant
INSERT INTO tenants (tenant_code, tenant_name) VALUES ('TNT01', 'tenant1');

-- Recupero dell'ID dell'utente appena inserito
SET @user_id = LAST_INSERT_ID();

-- Inserimento delle categorie
INSERT INTO categories (cat_name, tenant_code) VALUES ('Category 1', 'TNT01');
INSERT INTO categories (cat_name, tenant_code) VALUES ('Category 2', 'TNT01');
INSERT INTO categories (cat_name, tenant_code) VALUES ('Category 3', 'TNT01');
INSERT INTO categories (cat_name, tenant_code) VALUES ('Category 4', 'TNT01');
INSERT INTO categories (cat_name, tenant_code) VALUES ('Category 5', 'TNT01');


```

**problema:**
organizzazione appunti scolastici

**target:**
Studenti


**libreria utlizzata:**
https://richtexteditor.com/

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



## ER, SCHEMA RELAZIONALE E RELAZIONE:

![er](https://github.com/Gavoci/NoteStudio/assets/101709194/1b48d465-233c-49ce-a9cc-1ef57ae923e7)

**single-tenant:**
- users(<ins>user_id</ins>, user_role, user_name, user_email, user_phone, user_age, user_gender, user_password, user_joined)
- notes(<ins>note_id</ins>, note_user, note_title, note_desc, note_views, note_cat)
- categories(<ins>cat_id</ins>, cat_name)


![er-multy-tenant](https://github.com/Gavoci/NoteStudio/assets/101709194/32f74ed6-cb1c-4f9b-979f-97c4699651e8)

**multi-tenant:**
- users(user_id, tenant_id, user_role, user_name, user_email, user_phone, user_age, user_gender, user_password, user_joined)
- notes(note_id, tenant_id, note_user, note_title, note_desc, note_views, note_cat)
- categories(cat_id, tenant_id, cat_name)
- tenants(tenant_id, tenant_name)

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

