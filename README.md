# NoteStudio
**problema:**
organizzazione appunti scolastici

**target:**
Studenti

## funzionalità:
 - possibilità di creare, modificare o eliminare una nota
 - possibilità di creare, modificare o eliminare una categoria
 - condivisione delle note
 - editor di testo con grandezza caratteri, colore, ecc (usando una libreria .js)
 - pagina di login per il sito con autenticazione utente (usand una mail)
 - ricerca nota per nome


## relazioni:
- ogni *studente* ha più *note*
- ogni *nota* ha uno *studente*
- ogni *nota* ha una *categoria*
- ogni *categoria* ha più *note*
- ogni *studente* ha piu *categorie*
- ogni *categoria* ha uno *studente*

## ER:

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/6dec88ab-d921-4eff-a884-523edaf6d748)
## SCHEMA RELAZIONALE:
- studente(<u>ID</u>, mail, password, nome, cognome, n_note, n_categorie)
- nota(<u>ID</u>, titlo, corpo, n_caratteri, studente_ID, categoria_ID)
- categoria(<u>ID</u>, nome, studente_ID)


## mockup:

https://www.figma.com/file/TbxLa4QgpMk9C1MbGbAgtz/Notestudio-wileframe?type=design&node-id=1%3A7&mode=design&t=gUs77aq2aHaUR1dT-1
