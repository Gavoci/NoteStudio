<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
include 'config.php';
include 'functions.php';
$userId = $_SESSION['user_id'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        // Associating page identifiers with titles
        $pageTitles = array(
            "/" => "Login",
            "welcome.php" => "Home",
            "new_notes.php" => "Create New Notes",
            "notes_lists.php" => "Notes List",
            "new_category.php" => "Add New Category",
            "categories_list.php" => "Categories List",
            "editUserprofile.php"=> "Edit Profile"
        );

        // Get the current page filename
        $currentPage = basename($_SERVER['SCRIPT_FILENAME']);

        // Function to get the page title based on the current filename
        function getPageTitle($currentPage, $pageTitles)
        {
            // Check if the current filename exists in the pageTitles array
            if (array_key_exists($currentPage, $pageTitles)) {
                return $pageTitles[$currentPage]; // Return the corresponding title
            } else {
                return "Default Title"; // Set a default title for pages not defined in the array
            }
        }

        // Get the title for the current page
        $pageTitle = getPageTitle($currentPage, $pageTitles);

        // Display the dynamically set page title
        echo $pageTitle;
        ?>

    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- text editor css  -->
    <link rel="stylesheet" href="assets/texteditor/rte_theme_default.css">
    <!-- datatables  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/style.css">
   
  
</head>

<body>