<?php include 'partials/header.php';
include 'partials/navbar.php'; ?>
<main>
    <section>
        <div class="container my-4">
            <div class="card">
                <div class="card-body">
                    <?php include 'widgets/alert_message.php'; ?>
                    <h5 class="fw-bold mt-3">Edit Profile Details</h5>
                    <p class="text-secondary fs-14 mt-0 mb-3">Credentials add credibility to your content</p>
                    <?php

                    // Check if userId is set in the session
                    if (isset($_SESSION['user_id'])) {
                        $userId = $_SESSION['user_id'];

                        // Fetch user data based on the userId
                        $userData = getUserData($userId);

                        // Populate form fields with user data
                        ?>
                    <form action="php/updateUserProfile.php" class="row g-3" method="post">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="<?php echo $userData['name']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="age">Age</label>
                            <input type="number" name="age" id="age" class="form-control"
                                value="<?php echo $userData['age']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" id="gender" required>
                                <option value="" selected hidden>Choose...</option>
                                <option value="Male" <?php echo ($userData['gender'] === 'Male' ? 'selected' : ''); ?>>
                                    Male</option>
                                <option value="Female"
                                    <?php echo ($userData['gender'] === 'Female' ? 'selected' : ''); ?>>Female</option>
                                <option value="Other"
                                    <?php echo ($userData['gender'] === 'Other' ? 'selected' : ''); ?>>
                                    Other</option>
                            </select>
                        </div>
                       
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                    <?php
                    } else {
                        // Handle the case where userId is not set in the session
                        echo "User ID not found in session.";
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
</main>
<script>
// Function to populate years in select dropdown
function populateYears(selectId, selectedYear) {
    const select = document.getElementById(selectId);
    const currentYear = new Date().getFullYear();

    for (let year = currentYear; year >= 1950; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        select.appendChild(option);
    }

    // Set the selected option
    if (selectedYear !== null) {
        document.getElementById(selectId).value = selectedYear;
    }
}

// Get the selected year from PHP/Server
const startYearDB = <?php echo json_encode($userData['companyStart']); ?>;
const endYearDB = <?php echo json_encode($userData['companyEnd']); ?>;
const graduationYearDB = <?php echo json_encode($userData['graduationYear']); ?>;

// Call the function to populate the start year select element and select the option
populateYears('startYear', startYearDB);
populateYears('endYear', endYearDB);
populateYears('graduationYear', graduationYearDB);
</script>
<script>
// Function to populate years in select dropdown
function populateYears(selectId) {
    const select = document.getElementById(selectId);
    const currentYear = new Date().getFullYear();

    for (let year = currentYear; year >= 1900; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        select.appendChild(option);
    }
}

// Call the function to populate the endYear select element
populateYears('endYear');

// Add event listener to endYear select dropdown
document.getElementById('endYear').addEventListener('change', function() {
    // Uncheck the currentlyWorking checkbox when endYear is selected
    document.getElementById('flexSwitchCheckDefault').checked = false;
});
</script>
<?php include 'partials/javascripts.php'; ?>
