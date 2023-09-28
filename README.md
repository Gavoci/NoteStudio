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

## elementi:
- *Categoria* --> nomeCategria
- *Studente* --> mail, password, nome, cognome
- *nota* --> titolo, corpo, nCaratteri, ultimaModifica, CategoriaAppartenente

## relazioni:
- ogni *studente* ha più *note*
- ogni *nota* ha più *studenti*
- ogni *nota* ha una *categoria*
- ogni *categoria* ha più *note*
- ogni *studente* ha piu *categorie*
- ogni *categoria* ha uno *studente*

## ER:

![ER_noteStudio](https://github.com/Gavoci/NoteStudio/assets/101709194/6dec88ab-d921-4eff-a884-523edaf6d748)


## mockup:

https://www.figma.com/file/TbxLa4QgpMk9C1MbGbAgtz/Notestudio-wileframe?type=design&node-id=1%3A7&mode=design&t=gUs77aq2aHaUR1dT-1
