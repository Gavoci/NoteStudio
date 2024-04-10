<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 
?>
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
                        // Fetch user data based on the userId
                        $userId = $_SESSION['user_id'];
                        $userData = getUserData($userId);

                        // Populate form fields with user data
                        ?>
                        <form action="php/updateUserProfile.php" class="row g-3" method="post">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="age">Age</label>
                                <input type="number" name="age" id="age" class="form-control"
                                    value="<?php echo htmlspecialchars($userData['age']); ?>" required>
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
<?php include 'partials/javascripts.php'; ?>
