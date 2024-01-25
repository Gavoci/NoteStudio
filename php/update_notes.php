<?php
include("../config.php");
session_start();

$redirect = $_SERVER['HTTP_REFERER'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $noteId = $_POST['noteId'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $desc = $_POST['desc'];
    $privacy = isset($_POST['privacy']) ? 1 : 0; // Check if privacy is selected

    // Prepared statement to update the database with the new data
    $sql = "UPDATE notes SET note_title=?, note_cat=?, note_tags=?, note_desc=?, note_privacy=? WHERE note_id=?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssii", $title, $category, $tags, $desc, $privacy, $noteId);
        if ($stmt->execute()) {
            // Redirect to a success page or perform other actions upon successful update
            $_SESSION['message'] = "Note updated successfully!";
            $_SESSION['type'] = "success";
            header("Location: ../notes_lists.php");
            exit();
        } else {
            $_SESSION['message'] = "$stmt->error";
            $_SESSION['type'] = "danger";
            header("Location: $redirect");
            exit();
        }
    } else {
        echo "Error in prepared statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>