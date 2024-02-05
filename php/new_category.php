<?php
session_start();

include("../config.php"); // Include your database connection or configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['categoryName']) && !empty(trim($_POST['categoryName']))) {
        $categoryName = $_POST['categoryName'];
        
        // Check if the category name already exists in the database
        $stmt_check = $conn->prepare("SELECT * FROM categories WHERE cat_name = ?");
        $stmt_check->bind_param('s', $categoryName);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Category <b>".$categoryName."</b> already exists!";
            $_SESSION['type'] = "danger";
        } else {
            // Prepare and execute the SQL query to insert a new category into the database
            $stmt_insert = $conn->prepare("INSERT INTO categories (cat_name) VALUES (?)");
            $stmt_insert->bind_param('s', $categoryName);
            
            if ($stmt_insert->execute()) {
                $_SESSION['message'] = "Category <b>".$categoryName."</b> added successfully!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to add category!";
                $_SESSION['type'] = "danger";
                
            }
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['message'] = "Category name cannot be empty!";
        $_SESSION['type'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
