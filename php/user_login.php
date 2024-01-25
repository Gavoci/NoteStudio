<?php
session_start();

include("../config.php"); // Include your database connection or configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to select user based on email or phone
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? OR user_phone = ?");
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['user_password'])) {
            // Password is correct, start session and set data
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['user_name'] = $row['user_name'];
            
            // After password matching redirect to dashboard page 
            header("Location: ../welcome.php");
            exit();
        } else {
            $_SESSION['message'] = "Invalid credentials. Please try again.";
            $_SESSION['type'] = "danger";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found. Please register or try again.";
        $_SESSION['type'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
