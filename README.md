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

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/bf050b62-7db3-4407-9899-53589562c3ce)


## SCHEMA RELAZIONALE:
- studente(<ins>ID</ins>, mail, password, nome, cognome)
- nota(<ins>ID</ins>, titolo, corpo, n_caratteri, studente_ID, categoria_ID)
- categoria(<ins>ID</ins>, nome, studente_ID)


## mockup:

<ins>inserimento blocco:</ins>
![aggiunta blocco](https://github.com/Gavoci/NoteStudio/assets/101709194/35ca61db-8d24-4bb9-b479-c7d5aafe7dc7)


<ins>modifica testo:</ins>
![modifica testo](https://github.com/Gavoci/NoteStudio/assets/101709194/f9cb6048-932b-40e2-b421-db9c536c7b50)


<ins>sign in:</ins>
![Senza titolo](https://github.com/Gavoci/NoteStudio/assets/101709194/d3f852ca-a1b4-452f-9c73-0a919fc7b437)

<ins>login in:</ins>
![Senza titolo](https://github.com/Gavoci/NoteStudio/assets/101709194/7e28dd47-d370-45a8-bfc9-a22a7ff2064c)


