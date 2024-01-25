<?php
session_start();
include("../config.php");

// Check if 'noteId' is present in the URL
if (isset($_GET['noteId'])) {
    $noteId = $_GET['noteId']; // Get the note ID from the URL parameter

    // Update note_view count by incrementing by 1
    $updateQuery = "UPDATE notes SET note_views = note_views + 1 WHERE note_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $noteId);
    
    if ($stmt->execute()) {
        // Redirect the user to the specific link address
        header("Location: ../view_notes.php?noteId=$noteId");
        exit();
    } else {
        echo "Error updating note view count: " . $conn->error;
    }
} else {
    echo "Note ID not provided.";
}
?>
