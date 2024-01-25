<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['delete_note'], $_POST['noteId'], $_POST['status'])) {

    $noteId = $_POST['noteId'];
    $status = $_POST['status'];

    // Elimina la nota dal database
    $sqlDeleteNote = "DELETE FROM notes WHERE note_id = ?";
    $stmtDeleteNote = $conn->prepare($sqlDeleteNote);

    if ($stmtDeleteNote) {
        $stmtDeleteNote->bind_param("i", $noteId);
        $stmtDeleteNote->execute();

        if ($stmtDeleteNote->affected_rows > 0) {

            // Rimuovi la nota anche dalle note dell'utente
            $sqlDeleteUserNote = "DELETE FROM user_notes WHERE note_id = ?";
            $stmtDeleteUserNote = $conn->prepare($sqlDeleteUserNote);

            if ($stmtDeleteUserNote) {
                $stmtDeleteUserNote->bind_param("i", $noteId);
                $stmtDeleteUserNote->execute();
                $stmtDeleteUserNote->close();
            }
        }

        $stmtDeleteNote->close();
    }
}

$redirect = $_SERVER['HTTP_REFERER'];
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
