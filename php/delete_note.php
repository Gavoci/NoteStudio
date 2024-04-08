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
            $_SESSION['message'] = "Note deleted successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to delete note!";
            $_SESSION['type'] = "danger";
        }

        $stmtDeleteNote->close();
    } else {
        $_SESSION['message'] = "Error in prepared statement: " . $conn->error;
        $_SESSION['type'] = "danger";
    }
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
