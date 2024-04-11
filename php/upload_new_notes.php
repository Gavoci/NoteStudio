<?php
session_start();

include("../config.php");

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'], $_POST['category'], $_POST['desc'])) {
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['desc'];

        // Recupera il tenant_code dal database in base all'ID utente in sessione
        $stmt = $conn->prepare("SELECT tenant_code FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $tenantCode = $row['tenant_code'];

            // Prepare and execute the SQL query to insert form data into the database
            $stmt = $conn->prepare("INSERT INTO notes (note_user, note_title, note_cat, note_desc, note_views, tenant_code)
                VALUES (?, ?, ?, ?, 0, ?)"); // Imposta note_views a 0
            $stmt->bind_param("issss", $userId, $title, $category, $description, $tenantCode);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Note added successfully!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to add note!";
                $_SESSION['type'] = "danger";
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "User not found or invalid user!";
            $_SESSION['type'] = "danger";
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
