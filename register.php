<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="row align-items-center justify-content-center vh-100 vw-100">
        <div class="col-lg-6 d-none d-md-none d-lg-block">
            <img src="assets/img/login.svg" alt="" class="object-fit-contain w-100 vh-100 justify-content-strecth">
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card rounded-4 border border-0 p-3">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="logo display-5 mb-5">NoteStudio</h4>
                            </div>
                            <h5 class="fs-2 fw-bold mb-1">Sign Up</h5>
                            <p class="text-secondary mb-4">Enter your details to sign up with us </p>
                            <?php include 'widgets/alert_message.php'; ?>

                            <form action="php/user_registration.php" method="post" class="row g-3">
                                <div class="col-12">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label for="age">Age</label>
                                    <input type="number" name="age" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="" selected hidden>Choose Gender...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" required>
                                        <button type="button" class="btn btn-light border" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirmPassword" class="form-control" required>
                                        <button type="button" class="btn btn-light border" id="toggleConfirmPassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="tenant_code">Tenant Code</label>
                                    <input type="text" name="tenant_code" class="form-control" required>
                                </div>
                                <div class="d-grid">
                                    <input type="submit" value="Sign Up" class="btn btn-primary">
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <p class="text-secondary">Already have an account ? <a href="index.php"
                                        class="text-decoration-none">Log in </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmPasswordInput = document.querySelector('input[name="confirmPassword"]');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            togglePassword.addEventListener('click', function () {
                togglePasswordVisibility(passwordInput, togglePassword);
            });

            toggleConfirmPassword.addEventListener('click', function () {
                togglePasswordVisibility(confirmPasswordInput, toggleConfirmPassword);
            });

            function togglePasswordVisibility(inputField, toggleButton) {
                const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', type);
                toggleButton.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            }
        });
    </script>
    <script>
        setTimeout(function () {
            document.getElementById('alertMessage').style.display = 'none';
        }, 5000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>
