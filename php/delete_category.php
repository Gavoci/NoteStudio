<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['delete_category'], $_POST['catId'], $_POST['status'])) {

    $catId = $_POST['catId'];
    $status = $_POST['status'];

    // Elimina la categoria dal database
    $sqlDeleteCategory = "DELETE FROM categories WHERE cat_id = ?";
    $stmtDeleteCategory = $conn->prepare($sqlDeleteCategory);

    if ($stmtDeleteCategory) {
        $stmtDeleteCategory->bind_param("i", $catId);
        $stmtDeleteCategory->execute();

        if ($stmtDeleteCategory->affected_rows > 0) {
            $_SESSION['message'] = "Category deleted successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to delete category!";
            $_SESSION['type'] = "danger";
        }

        $stmtDeleteCategory->close();
    } else {
        $_SESSION['message'] = "Error in prepared statement: " . $conn->error;
        $_SESSION['type'] = "danger";
    }
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
