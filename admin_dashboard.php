<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($_SESSION['admin_id'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>

    <link rel="stylesheet" href="css/style-dashboard.css">
</head>
<body>
    
<div class="sidebar">
   <h1>NoteStudio</h1>
   <a href="index.php">Studenti</a>
   <a href="">Categorie</a>
   <a href="">Note</a>
   <a href="admin_profile_update.php">settings</a>
   <a href="logout.php">logout</a>
</div>
</body>
</html>
