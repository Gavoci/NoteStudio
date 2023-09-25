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
 - pagina di login per il sito con autenticazione utente
 - ricerca nota per nome

## elementi:
- *Categoria* --> nomeCategria
- *Studente* --> mail, password, nome, cognome
- *nota* --> titolo, corpo, nCaratteri, ultimaModifica, CategoriaAppartenente

## relazioni
- ogni *studente* ha più *note*
- ogni *nota* ha più *studenti*
- ogni *nota* ha una *categoria*
- ogni *categoria* ha più *note*
- ogni *studente* ha piu *categorie*
- ogni *categoria* ha uno *studente*
