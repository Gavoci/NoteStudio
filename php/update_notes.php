<?php
include("../config.php");
session_start();

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../notes_lists.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $noteId = $_POST['noteId'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $desc = $_POST['desc'];

    // Prepared statement to update the database with the new data
    $sql = "UPDATE notes SET note_title=?, note_cat=?, note_desc=? WHERE note_id=?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssi", $title, $category, $desc, $noteId);
        if ($stmt->execute()) {
            // Redirect to a success page or perform other actions upon successful update
            $_SESSION['message'] = "Note updated successfully!";
            $_SESSION['type'] = "success";
            header("Location: ../notes_lists.php");
            exit();
        } else {
            $_SESSION['message'] = "Failed to update note!";
            $_SESSION['type'] = "danger";
            header("Location: $redirect");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error in prepared statement: " . $conn->error;
        $_SESSION['type'] = "danger";
        header("Location: $redirect");
        exit();
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} 
?>
