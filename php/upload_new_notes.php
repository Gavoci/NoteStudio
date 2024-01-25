<?php
session_start();

include("../config.php");

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'], $_POST['category'], $_POST['tags'], $_POST['desc'])) {
        $userId = $_SESSION['user_id'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $tags = $_POST['tags'];
        $description = $_POST['desc'];
        $privacy = isset($_POST['privacy']) ? 1 : 0;
        $imageName = null; // Default value if no image is uploaded

        // Image file handling
        if (!empty($_FILES['fileImage']['name'])) {
            $imageUploadDirectory = '../assets/notesImages/';
            $uploadedImageName = $_FILES['fileImage']['name'];
            $imageTempName = $_FILES['fileImage']['tmp_name'];

            // Get only the image name without the path
            $imageName = basename($uploadedImageName);

            $imagePath = $imageUploadDirectory . $imageName;

            // Move uploaded image to the desired directory
            move_uploaded_file($imageTempName, $imagePath);
        }

        // Prepare and execute the SQL query to insert form data into the database
        $stmt = $conn->prepare("INSERT INTO notes (note_user, note_title, note_cat, note_tags, note_desc, note_image, note_privacy)
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $userId, $title, $category, $tags, $description, $imageName, $privacy);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Note added successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to add note!";
            $_SESSION['type'] = "danger";

        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
