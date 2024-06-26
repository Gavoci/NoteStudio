<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'], $_POST['age'], $_POST['gender'])) {
    $userId = $_SESSION['user_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    
    // Check if user role field is set and the user role is 2 (Admin)
    if (isset($_POST['userRole']) && $_POST['userRole'] === '1') {
        $userRole = 1; // Set user role to 1 (Admin)
    } else {
        $userRole = 0; // Set user role to 0 (User)
    }

    // Prepare and execute the query to update user details
    $updateQuery = "UPDATE users SET user_name = ?, user_age = ?, user_gender = ?, user_role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($stmt) {
        $stmt->bind_param("sisii", $name, $age, $gender, $userRole, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // If user details are successfully updated, set success message and redirect
            $_SESSION['message'] = "Profile details updated successfully!";
            $_SESSION['type'] = "success";
            header("Location: ../edit_user.php");
            exit();
        } else {
            // If no rows are affected, set error message and redirect
            $_SESSION['message'] = "Failed to update profile details!";
            $_SESSION['type'] = "danger";
            header("Location: ../edit_user.php");
            exit();
        }
        $stmt->close();
    } else {
        // If prepared statement fails, set error message and redirect
        $_SESSION['message'] = "Error in prepared statement for updating profile details: " . $conn->error;
        $_SESSION['type'] = "danger";
        header("Location: ../edit_user.php");
        exit();
    }
} else {
    // If request method is not POST or required fields are not set, redirect to edit_user.php
    header("Location: ../edit_user.php");
    exit();
}
?>
