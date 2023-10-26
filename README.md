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
 - condivisione delle note
 - editor di testo con grandezza caratteri, colore, ecc (usando una libreria .js)
 - pagina di login per il sito con autenticazione utente (usando una mail)
 - ricerca nota per nome


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
- ha_scritto(data_modifica)


## mockup:

https://www.figma.com/file/TbxLa4QgpMk9C1MbGbAgtz/Notestudio-wileframe?type=design&node-id=1%3A7&mode=design&t=gUs77aq2aHaUR1dT-1

![schermata1](https://github.com/Gavoci/NoteStudio/assets/101709194/5d94a826-d637-4037-9441-cb52646ae55f)
![schermata2](https://github.com/Gavoci/NoteStudio/assets/101709194/65e21f65-d979-4ff8-ae49-67863fedd6b2)
![Senza titolo](https://github.com/Gavoci/NoteStudio/assets/101709194/d3f852ca-a1b4-452f-9c73-0a919fc7b437)


