<?php
include 'config.php';

if (isset($_POST['studentId'])) {
   $studentId = $_POST['studentId'];

   $deleteStmt = $conn->prepare("DELETE FROM studente WHERE id = ?");
   $deleteStmt->execute([$studentId]);
}
?>
