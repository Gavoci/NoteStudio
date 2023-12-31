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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style-landingPage.css">

</head>
<body>
<h1 class="title"> <span>admin</span> profile page </h1>

<?php
      $select_profile = $conn->prepare("SELECT * FROM `studente` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

<div class="container">

   <div class="content">
      <h3>hi, <span>admin</span></h3>
      <h1>welcome <span><?= $fetch_profile['name']; ?></span></h1>
      <p>Welcome in <u>NoteStudio</u> </p>
      <a href="admin_dashboard.php" class="btn">dashboard</a>
   </div>

</div>

</body>
</html>
