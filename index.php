<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
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
    <title>Login</title>
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
                                <h4 class="logo display-6 mb-5">NoteStudio</h4>
                            </div>
                            <h5 class="fs-2 fw-bold mb-1">Log In</h5>
                            <p class="text-secondary mb-4">Enter login details to access our services </p>
                            <?php include 'widgets/alert_message.php'; ?>

                            <form action="php/user_login.php" method="post" class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="username" id="" class="form-control"
                                        placeholder="Email or Phone Number">
                                </div>
                                <div class="col-12">
                                    <div class="input-group">
                                        <input type="password" name="password" id="passwordInput" class="form-control"
                                            placeholder="Password">
                                        <button type="button" id="togglePassword" class="btn btn-light border"><i
                                                class="bi bi-eye"></i></button>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <input type="submit" value="Log In" class="btn btn-primary">
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <p class="text-secondary">Don't have an account ? <a href="register.php"
                                        class="text-decoration-none">Sign Up </a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('passwordInput');
            const togglePassword = document.getElementById('togglePassword');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Change the eye icon based on the password visibility
                togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            });
        });

    </script>
    <script>
        // Automatically hide the alert after 5 seconds
        setTimeout(function () {
            document.getElementById('alertMessage').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>