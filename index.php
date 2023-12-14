<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Elenco studenti</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-login-register.css">
</head>
<body>

<h1 class="title">Elenco studenti</h1>

<div class="search-container">
   <input type="text" id="search" placeholder="Cerca per nome">
</div>

<table id="studentTable">
   <!-- La tabella degli studenti verrà caricata qui -->
</table>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      // Carica la lista degli studenti all'avvio della pagina
      loadStudentList();

      // Ricerca degli studenti
      document.getElementById('search').addEventListener('input', function() {
         loadStudentList(this.value);
      });

      // Elimina uno studente
      document.addEventListener('click', function(event) {
         if (event.target.classList.contains('deleteBtn')) {
            var studentId = event.target.getAttribute('data-id');
            if (confirm('Sei sicuro di voler eliminare questo studente?')) {
               deleteStudent(studentId);
            }
         }
      });

      // Modifica uno studente
      document.addEventListener('click', function(event) {
         if (event.target.classList.contains('editBtn')) {
            // Implementa la logica per la modifica dello studente
         }
      });

      // Funzione per caricare la lista degli studenti
      function loadStudentList(search = '') {
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
               document.getElementById('studentTable').innerHTML = xhr.responseText;
            }
         };
         xhr.open('POST', 'get_students.php', true);
         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         xhr.send('search=' + search);
      }

      // Funzione per eliminare uno studente
      function deleteStudent(studentId) {
         var xhr = new XMLHttpRequest();
         xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
               loadStudentList(document.getElementById('search').value);
            }
         };
         xhr.open('POST', 'delete_student.php', true);
         xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
         xhr.send('studentId=' + studentId);
      }
   });
</script>

</body>
</html>
