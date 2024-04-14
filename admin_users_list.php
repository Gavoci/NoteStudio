<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; 

$user_id = $_SESSION['user_id'];

// Query per ottenere il tenant_code dell'utente dalla tabella users
$tenantCodeQuery = "SELECT tenant_code FROM users WHERE user_id = '$user_id'";
$tenantCodeResult = $conn->query($tenantCodeQuery);

if ($tenantCodeResult->num_rows > 0) {
    $tenant_row = $tenantCodeResult->fetch_assoc();
    $tenant_code = $tenant_row['tenant_code'];

    // Query per ottenere gli utenti associati al tenant_code
    $fetchUsersQuery = "SELECT * FROM users WHERE tenant_code = '$tenant_code'";
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
                        ?>
                        <div class="col-md-4"> <!-- Modificato a col-md-4 per mostrare le cards su tre colonne -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
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
                                        </div>
                                        <div class="col-md-4 d-none d-md-block"> <!-- Aggiunta la classe d-md-block per nascondere il dropdown su schermi più piccoli -->
                                            <div class="dropdown">
                                                <button class="btn btn-light border btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="edit_user.php?userId=<?= $user_id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal-<?= $user_id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- delete modal  -->
                                        <div class="modal fade" id="deleteModal-<?= $user_id ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"> <i
                                                                class="bi bi-exclamation-triangle-fill"></i> Are you sure ? </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        This action <b>CANNOT</b> be undone. This will permanently delete the user <b>
                                                            <?= $user_name ?>
                                                        </b>.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border"
                                                            data-bs-dismiss="modal">No, Keep it.</button>
                                                        <form action="php/delete_user.php" method="post">
                                                            <input type="hidden" name="userId" value="<?= $user_id ?>">
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="btn btn-danger" name="delete_user">Yes,
                                                                Delete <i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete modal end  -->
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
<?php } ?>
<?php include 'partials/javascripts.php'; ?>
