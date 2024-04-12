<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['catId'], $_POST['categoryName'])) {
    $catId = $_POST['catId'];
    $categoryName = $_POST['categoryName'];

    // Aggiorna la categoria nel database
    $sql = "UPDATE categories SET cat_name = ? WHERE cat_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $categoryName, $catId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Category updated successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to update category!";
            $_SESSION['type'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error in prepared statement for updating category: " . $conn->error;
        $_SESSION['type'] = "danger";
    }
}

$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
header("Location: $redirect"); // Redirect to the relevant page
exit();
?>
