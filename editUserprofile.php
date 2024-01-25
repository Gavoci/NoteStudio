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
                        <h6 class="fw-bold mt-4 mb-2">Employment Details</h6>
                        <div class="col-md-6">
                            <label for="position">Position</label>
                            <input type="text" name="position" class="form-control" id=""
                                value="<?php echo $userData['position']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="position">Company/Organization</label>
                            <input type="text" name="company" class="form-control" id=""
                                value="<?php echo $userData['company']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="startYear">Start Year</label>
                            <select name="startYear" class="form-control" id="startYear">
                                <option value="" selected hidden>Choose...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="endYear">End Year</label>
                            <select name="endYear" class="form-control" id="endYear">
                                <option value="" selected hidden>Choose...</option>
                            </select>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="currentlyWorking" role="switch"
                                    id="flexSwitchCheckDefault" <?php echo $userData['companyEnd']; ?>>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Currently working
                                    here.</label>
                            </div>
                        </div>
                        <h6 class="fw-bold mt-4 mb-0">Add education credential</h6>

                        <div class="col-md-6">
                            <label for="primary">Primary School</label>
                            <input type="text" name="primarySchool" class="form-control" id=""
                                value="<?php echo $userData['primarySchool']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="secondary">Secondary School</label>
                            <input type="text" name="secondarySchool" class="form-control" id=""
                                value="<?php echo $userData['secondarySchool']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="Degree Type">Degree (Optional)</label>
                            <input type="text" name="degree" class="form-control" id=""
                                value="<?php echo $userData['degreeName']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="graduationYear">Graduation Year</label>
                            <select name="graduationYear" class="form-control" id="graduationYear">
                                <option value="" selected hidden>Choose...</option>
                            </select>
                        </div>

                        <h6 class="fw-bold mt-4 mb-2">Add current living Location credentials</h6>
                        <div class="col-md-12">
                            <label for="location">Location</label>
                            <input type="text" name="location" class="form-control" id=""
                                value="<?php echo $userData['location']; ?>">
                        </div>
                        <h6 class="fw-bold mt-4 mb-2">Add about yourself </h6>
                        <div class="col-md-12">
                            <label for="location">Bio</label>
                            <textarea name="bioDetails" class="form-control" id="" cols="30" rows="5"
                                placeholder="Start writing here.."><?php echo $userData['bio']; ?></textarea>
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