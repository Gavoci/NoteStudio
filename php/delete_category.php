<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_category'], $_POST['catId'], $_POST['status'])) {
    $catId = $_POST['catId'];
    $status = $_POST['status'];

    // Inizia una transazione per garantire l'integrità dei dati
    $conn->begin_transaction();

    // Elimina le note collegate se ci sono
    $sqlDeleteNotes = "DELETE FROM notes WHERE note_cat = ?";
    $stmtDeleteNotes = $conn->prepare($sqlDeleteNotes);

    if ($stmtDeleteNotes) {
        $stmtDeleteNotes->bind_param("i", $catId);
        $stmtDeleteNotes->execute();
        $stmtDeleteNotes->close();
    } else {
        // Se la preparazione dello statement per la cancellazione delle note collegate ha fallito, annulla la transazione e imposta un messaggio di errore
        $conn->rollback();
        $_SESSION['message'] = "Error in prepared statement for deleting notes: " . $conn->error;
        $_SESSION['type'] = "danger";
        header("Location: ../index.php");
        exit();
    }

    // Elimina la categoria dal database
    $sqlDeleteCategory = "DELETE FROM categories WHERE cat_id = ?";
    $stmtDeleteCategory = $conn->prepare($sqlDeleteCategory);

    if ($stmtDeleteCategory) {
        $stmtDeleteCategory->bind_param("i", $catId);
        $stmtDeleteCategory->execute();

        if ($stmtDeleteCategory->affected_rows > 0) {
            // Se la cancellazione della categoria ha avuto successo, conferma la transazione
            $conn->commit();
            $_SESSION['message'] = "Category deleted successfully!";
            $_SESSION['type'] = "success";
        } else {
            // Se la cancellazione della categoria ha fallito, annulla la transazione e imposta un messaggio di errore
            $conn->rollback();
            $_SESSION['message'] = "Failed to delete category!";
            $_SESSION['type'] = "danger";
        }
        $stmtDeleteCategory->close();
    } else {
        // Se la preparazione dello statement per la cancellazione della categoria ha fallito, annulla la transazione e imposta un messaggio di errore
        $conn->rollback();
        $_SESSION['message'] = "Error in prepared statement for deleting category: " . $conn->error;
        $_SESSION['type'] = "danger";
    }
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
