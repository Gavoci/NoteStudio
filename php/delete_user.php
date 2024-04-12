<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['delete_user'], $_POST['userId'], $_POST['status'])) {

    $userId = $_POST['userId'];
    $status = $_POST['status'];

    // Controlla se l'utente sta cercando di cancellare se stesso
    $user_id = $_SESSION['user_id'];
    if ($userId == $user_id) {
        $_SESSION['message'] = "You cannot delete yourself!";
        $_SESSION['type'] = "danger";
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
        header("Location: $redirect"); // Redirect to the relevant page
        exit();
    }

    // Verifica se l'utente è un amministratore
    $sqlUserRole = "SELECT user_role FROM users WHERE user_id = ?";
    $stmtUserRole = $conn->prepare($sqlUserRole);

    if ($stmtUserRole) {
        $stmtUserRole->bind_param("i", $userId);
        $stmtUserRole->execute();
        $stmtUserRole->store_result();

        if ($stmtUserRole->num_rows == 1) {
            $stmtUserRole->bind_result($user_role);
            $stmtUserRole->fetch();

            // Verifica se l'utente è un amministratore
            if ($user_role == 1) {
                $_SESSION['message'] = "You cannot delete an administrator!";
                $_SESSION['type'] = "danger";
                $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
                header("Location: $redirect"); // Redirect to the relevant page
                exit();
            }

            // Elimina tutte le note associate all'utente
            $sqlDeleteNotes = "DELETE FROM notes WHERE note_user = ?";
            $stmtDeleteNotes = $conn->prepare($sqlDeleteNotes);

            if ($stmtDeleteNotes) {
                $stmtDeleteNotes->bind_param("i", $userId);
                $stmtDeleteNotes->execute();
                $stmtDeleteNotes->close();
            } else {
                $_SESSION['message'] = "Error deleting user's notes: " . $conn->error;
                $_SESSION['type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Error: User not found!";
            $_SESSION['type'] = "danger";
        }

        $stmtUserRole->close();
    } else {
        $_SESSION['message'] = "Error in prepared statement: " . $conn->error;
        $_SESSION['type'] = "danger";
    }

    // Elimina l'utente dal database
    $sqlDeleteUser = "DELETE FROM users WHERE user_id = ?";
    $stmtDeleteUser = $conn->prepare($sqlDeleteUser);

    if ($stmtDeleteUser) {
        $stmtDeleteUser->bind_param("i", $userId);
        $stmtDeleteUser->execute();

        if ($stmtDeleteUser->affected_rows > 0) {
            $_SESSION['message'] = "User deleted successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to delete user!";
            $_SESSION['type'] = "danger";
        }

        $stmtDeleteUser->close();
    } else {
        $_SESSION['message'] = "Error in prepared statement: " . $conn->error;
        $_SESSION['type'] = "danger";
    }
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
