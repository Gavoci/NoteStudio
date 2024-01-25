<?php
session_start();

include("../config.php");
// Function to check if email or phone number is already registered
function isAlreadyRegistered($conn, $email, $phone)
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? OR user_phone = ?");
    $stmt->bind_param('ss', $email, $phone); // 'ss' indicates two string parameters
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;
    return $count > 0 ? true : false;
}


// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email or phone number is already registered
    if (isAlreadyRegistered($conn, $email, $phone)) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "Email or phone number already registered !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Verify if the phone number is 10 digits
        if (strlen($phone) === 10 && is_numeric($phone)) {
            // Insert the data into the database
            $sql = "INSERT INTO users (user_name, user_email, user_phone, user_age, user_gender, user_password)
                    VALUES ('$name', '$email', '$phone', '$age', '$gender', '$password')";

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $_SESSION['type'] = "success";
            $_SESSION['message'] = "User registered successfully!";
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['type'] = "danger";
            $_SESSION['message'] = " Invalid Phone Number !";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>