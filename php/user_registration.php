<?php
session_start();

include("../config.php");

function isAlreadyRegistered($conn, $email, $phone)
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? OR user_phone = ?");
    $stmt->bind_param('ss', $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;
    return $count > 0 ? true : false;
}

function isValidPassword($password)
{
    if (strlen($password) < 8) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    if (!preg_match('/[\W]/', $password)) {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($age < 8) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "L'età è troppo bassa!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } elseif ($age > 120) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "L'età non è un numero reale!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if (!isValidPassword($password)) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "La password deve avere almeno un carattere speciale, deve essere lunga almeno 8 caratteri, e deve contenere almeno un numero, almeno una lettera, e almeno una lettera maiuscola!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if (isAlreadyRegistered($conn, $email, $phone)) {
        $_SESSION['type'] = "danger";
        $_SESSION['message'] = "Email or phone number already registered!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        if (strlen($phone) === 10 && is_numeric($phone)) {
            // Hash the confirmation password
            $hashedConfirmPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

            // Compare hashed passwords
            if (!password_verify($confirmPassword, $hashedConfirmPassword)) {
                $_SESSION['type'] = "danger";
                $_SESSION['message'] = "Passwords do not match!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $sql = "INSERT INTO users (user_name, user_email, user_phone, user_age, user_gender, user_password, user_role)
        VALUES ('$name', '$email', '$phone', '$age', '$gender', '$password', 0)";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $_SESSION['type'] = "success";
            $_SESSION['message'] = "User registered successfully!";
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['type'] = "danger";
            $_SESSION['message'] = "Invalid Phone Number!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
