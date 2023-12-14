<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['user_id'];

if(!isset($_SESSION['user_id'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-landingPage.css">

</head>
<body>
<h1 class="title"> <span>user</span> profile page </h1>

<?php
      $select_profile = $conn->prepare("SELECT * FROM `studente` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?= $fetch_profile['name']; ?></span></h1>
      <p>Welcome in <u>NoteStudio</u> </p>
      <a href="user_profile_update.php" class="btn">update profile</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>
