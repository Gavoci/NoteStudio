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

## mockup:

![mockup](https://github.com/Gavoci/NoteStudio/assets/101709194/666bebe4-de8f-484c-8502-894dc506191d)

![login mockup](https://github.com/Gavoci/NoteStudio/assets/101709194/977bfe41-5d8c-4aab-9e6f-d403a356bff8)
