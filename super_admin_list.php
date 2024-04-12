<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 
?>
<main>
    <section>
        <div class="container my-4">
            <?php include 'widgets/alert_message.php'; ?>
            <h5 class="fw-bold mt-3">Edit Profile Details</h5>
            <p class="text-secondary fs-14 mt-0 mb-3">Credentials add credibility to your content</p>
            <?php

            // Fetch users with user_role = 1 without tenant control
            $fetchUsersQuery = "SELECT * FROM users WHERE user_role = 1";
            $fetchUsersResult = $conn->query($fetchUsersQuery);

            if ($fetchUsersResult->num_rows > 0) {
                ?>
                <main>
                    <div class="container my-4">
                        <h5 class="fw-bold">User List</h5>
                        <div class="row g-3">
                            <?php
                            while ($user = $fetchUsersResult->fetch_assoc()) {
                                // set data 
                                $user_id = $user['user_id'];
                                $user_name = $user['user_name'];
                                $user_email = $user['user_email'];
                                $user_phone = $user['user_phone'];
                                $user_age = $user['user_age'];
                                $user_joined = date("d M Y", strtotime($user['user_joined']));
                                $tenant_code = $user['tenant_code']; // Aggiunto il tenant_code
                                ?>
                                <div class="col-12">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-12 col-lg-8">
                                                    <p class="text-secondary mb-0 fs-14 text-capitalize">
                                                        <i class="bi bi-person-fill"></i>
                                                        <span class="fw-bold"><?= $user_name ?></span>
                                                    </p>
                                                    <p class="text-secondary fs-14 mb-0">
                                                        <?= $user_email ?>
                                                    </p>
                                                    <p class="text-secondary fs-14 mb-0">
                                                        <?= $user_phone ?>
                                                    </p>
                                                    <p class="text-secondary fs-14 mb-0">
                                                        <?= $user_age ?> years old
                                                    </p>
                                                    <p class="text-secondary fs-14 mb-0">
                                                        Joined on <?= $user_joined ?>
                                                    </p>
                                                    <p class="text-secondary fs-14 mb-0">
                                                        <span class="fw-bold">Tenant Code:</span> <?= $tenant_code ?> <!-- Mostra il tenant_code in grassetto -->
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 d-none d-lg-block">
                                                    <div class="dropdown">
                                                        <button class="btn btn-light border btn-sm dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="edit_user.php?userId=<?= $user_id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </main>
            <?php } else { ?>
                <main>
                    <div class="container my-4">
                        <div class="card rounded-4 border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">No Users found!</h5>
                            </div>
                        </div>
                    </div>
                </main>
            <?php } ?>
        </div>
    </section>
</main>
<?php include 'partials/javascripts.php'; ?>
