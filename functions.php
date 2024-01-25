<?php
$userId = $_SESSION['user_id'];

function fetchCategoryNames($conn)
{
    $options = '';
    $sql = "SELECT cat_id, cat_name FROM categories";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $conn->error; // Print error if query fails
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $catId = $row['cat_id'];
                $catName = $row['cat_name'];
                $options .= "<option value='$catId'>$catName</option>";
            }
        } else {
            $options .= "<option>No Categories Found !</option>";
        }
    }

    return $options; // Return the options
}

// Calculate total notes by user
function calculateTotalNotes($conn, $userId)
{

    // Using a prepared statement to avoid SQL injection
    $sql = "SELECT COUNT(note_id) AS totalNotes FROM notes WHERE note_user = ? AND notes_status = 0";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the user ID parameter
        $stmt->bind_param("i", $userId);

        // Execute the prepared statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $totalNotes = $row['totalNotes'];
            return $totalNotes; // Return the total count of notes
        } else {
            return 0; // Return 0 if no result found
        }
    } else {
        echo "Error: " . $conn->error; // Print error if prepare fails
    }
}


// calculate total users 
function countTotalUsers($conn)
{
    // Using a prepared statement to avoid SQL injection
    $sql = "SELECT COUNT(user_id) AS totalUsers FROM users WHERE user_role = 0";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Execute the prepared statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $totalUsers = $row['totalUsers'];
            return $totalUsers; // Return the total count of public notes
        } else {
            return 0; // Return 0 if no result found
        }
    } else {
        echo "Error: " . $conn->error; // Print error if prepare fails
    }
}

// fetch selected category value from database to edit notes details 
function fetchSelectedCategory($conn, $selectedCatId)
{
    $options = '';
    $sql = "SELECT cat_id, cat_name FROM categories";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $conn->error; // Print error if query fails
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $catId = $row['cat_id'];
                $catName = $row['cat_name'];
                $selected = ($selectedCatId == $catId) ? 'selected' : '';
                $options .= "<option value='$catId' $selected>$catName</option>";
            }
        } else {
            $options .= "<option>No Categories Found !</option>";
        }
    }

    return $options; // Return the options
}


//calculate total notes filter by category ID
function countNotesByCategoryId($categoryId) {
    global $conn; // Assuming $conn is your database connection variable

    $countQuery = "SELECT COUNT(*) AS total_notes FROM notes WHERE note_cat = ?";
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['total_notes']; // Return total number of notes for the category ID
}

// fetch notes details by passing note ID 
function getNoteDetailsById($noteId, $conn) {
    $noteId = intval($noteId); // Sanitize the input as an integer

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM notes 
                            INNER JOIN categories ON categories.cat_id = notes.note_cat 
                            WHERE note_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $noteId); // Bind the note_id parameter
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Fetch note details
            $noteDetails = $result->fetch_assoc();
            $noteDetails['title'] = $noteDetails['note_title']; // Add 'title' to the fetched note details
            return $noteDetails; // Return the fetched note details with the 'title' key
        } else {
            return null; // Return null if no data found for the note_id
        }
    } else {
        return null; // Return null if the statement preparation failed
    }
}


// Function to fetch user data by user ID
function getUserData($userId)
{
    global $conn; // Assuming $conn is your database connection

    // Prepare SQL statement to fetch user data by user ID
    $sql = "SELECT user_name, user_age, user_gender, user_position, user_company, user_companyStart, user_companyEnd, user_primary, user_secondary, user_degreeName, user_graduationYear, user_location, user_bio, user_joined FROM users WHERE user_id = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    // Bind the result to variables
    $stmt->bind_result($name, $age, $gender, $position, $company, $companyStart, $companyEnd, $primarySchool, $secondarySchool, $degreeName, $graduationYear, $location, $bio, $date);

    // Fetch the result
    $stmt->fetch();

    // Return the fetched data as an associative array
    return [
        'name' => $name,
        'age' => $age,
        'gender' => $gender,
        'position' => $position,
        'company' => $company,
        'companyStart' => $companyStart,
        'companyEnd' => $companyEnd,
        'primarySchool' => $primarySchool,
        'secondarySchool' => $secondarySchool,
        'degreeName' => $degreeName,
        'graduationYear' => $graduationYear,
        'location' => $location,
        'bio' => $bio,
        'joined' => $date
    ];
}

?>