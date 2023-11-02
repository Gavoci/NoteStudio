# NoteStudio
**problema:**
organizzazione appunti scolastici

**target:**
Studenti

**libreria utlizzata:**
https://editorjs.io/

## funzionalità:
 - possibilità di creare, modificare o eliminare una nota
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

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/020f4285-d32d-479d-8f72-fccc32253bc4)



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
