# NoteStudio
**problema:**
organizzazione appunti scolastici

**target:**
Studenti

**libreria utlizzata:**
https://editorjs.io/

## funzionalità:
 - possibilità di creare, modificare o eliminare una nota (due note non possono avere due nomi uguali)
 - possibilità di creare, modificare o eliminare una categoria (due categorie non possono avere due nomi uguali)
 - editor di testo con grandezza caratteri, colore, ecc (usando una libreria .js)
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

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/694c6fde-70ab-4962-a75b-376494c15253)
## SCHEMA RELAZIONALE:
- studente(<ins>ID</ins>, mail, password, nome, cognome, n_note, n_categorie)
- nota(<ins>ID</ins>, titolo, corpo, n_caratteri, studente_ID, categoria_ID)
- categoria(<ins>ID</ins>, nome, studente_ID)


## mockup:

<ins>inserimento blocco:</ins>
![schermata1](https://github.com/Gavoci/NoteStudio/assets/101709194/9e439602-f0c8-4f01-87a1-423b1c68970d)

<ins>modifica testo:</ins>
![schermata2](https://github.com/Gavoci/NoteStudio/assets/101709194/1dbe1522-98ba-4c87-8b84-25b577827f8d)

<ins>login:</ins>
![Senza titolo](https://github.com/Gavoci/NoteStudio/assets/101709194/d3f852ca-a1b4-452f-9c73-0a919fc7b437)


