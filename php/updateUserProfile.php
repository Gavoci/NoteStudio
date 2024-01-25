<?php
include '../config.php';
// Start the session
session_start();

// Check if userId is set in the session
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Process form submission if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establish your database connection
        // Example: $conn = new mysqli("localhost", "username", "password", "database");

        // Check if the "currently working here" switch is checked
        $currentlyWorking = isset($_POST['currentlyWorking']) ? 1 : 0;

        // Get other form data
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $position = $_POST['position'];
        $company = $_POST['company'];
        $startYear = $_POST['startYear'];
        $endYear = isset($_POST['currentlyWorking']) ? 'checked' : $_POST['endYear'];
        $primarySchool = $_POST['primarySchool'];
        $secondarySchool = $_POST['secondarySchool'];
        $degree = $_POST['degree'];
        $graduationYear = $_POST['graduationYear'];
        $location = $_POST['location'];
        $bio = $_POST['bioDetails'];

        // Prepare and execute the update query
        $sql = "UPDATE users SET 
                user_name = ?, user_age = ?, user_gender = ?, user_position = ?, user_company = ?, 
                user_companyStart = ?, user_companyEnd = ?, user_primary = ?, user_secondary = ?, 
                user_degreeName = ?, user_graduationYear = ?, user_location = ?, user_bio = ?
                WHERE user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sisssssssssssi",
            $name,
            $age,
            $gender,
            $position,
            $company,
            $startYear,
            $endYear,
            $primarySchool,
            $secondarySchool,
            $degree,
            $graduationYear,
            $location,
            $bio,
            $userId
        );

        // Execute the update query
        if ($stmt->execute()) {
            $_SESSION['message'] = "Profile Updated successfully !";
            $_SESSION['type'] = "success";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error updating data: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    }
} else {
    echo "User ID not found in session.";
}
?>