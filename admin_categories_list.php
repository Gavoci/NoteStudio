<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; 

$user_id = $_SESSION['user_id'];

// Query per ottenere il tenant_code dell'utente dalla tabella users
$tenantCodeQuery = "SELECT tenant_code FROM users WHERE user_id = '$user_id'";
$tenantCodeResult = $conn->query($tenantCodeQuery);

if ($tenantCodeResult->num_rows > 0) {
    $tenant_row = $tenantCodeResult->fetch_assoc();
    $tenant_code = $tenant_row['tenant_code'];

    // Query per ottenere le categorie associate al tenant_code e il numero di note associate
    $FetchCategoriesDetailssql = "SELECT c.cat_id, c.cat_name, COUNT(n.note_id) as note_count FROM categories c LEFT JOIN notes n ON c.cat_id = n.note_cat WHERE c.tenant_code = '$tenant_code' GROUP BY c.cat_id";
    $FetchCategoriesDetailsresult = $conn->query($FetchCategoriesDetailssql);

    if ($FetchCategoriesDetailsresult->num_rows > 0) {
        ?>
        <main>
            <div class="container my-4">
                <h5 class="fw-bold">Categories List</h5>
                <div class="row g-3">
                    <?php
                    while ($FetchCategoriesDetailsrow = $FetchCategoriesDetailsresult->fetch_assoc()) {
                        // set data 
                        $cat_id = $FetchCategoriesDetailsrow['cat_id'];
                        $cat_name = $FetchCategoriesDetailsrow['cat_name'];
                        $note_count = $FetchCategoriesDetailsrow['note_count'];
                        ?>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <p class="text-secondary mb-0 fs-14 text-capitalize">
                                                <i class="bi bi-bookmark-fill"></i>
                                                <span class="fw-bold"><?= $cat_name ?></span>
                                            </p>
                                            <p class="text-secondary fs-14 mb-0"><strong>notes:</strong> <?= $note_count ?></p>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-light border btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="edit_category.php?catId=<?= $cat_id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal-<?= $cat_id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete modal  -->
                                <div class="modal fade" id="deleteModal-<?= $cat_id ?>" tabindex="-1"
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
                                                This action <b>CANNOT</b> be undone. This will permanently delete the <b>
                                                    <?= $cat_name ?>
                                                </b>.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light border"
                                                    data-bs-dismiss="modal">No, Keep it.</button>
                                                <form action="php/delete_category.php" method="post">
                                                    <input type="hidden" name="catId" value="<?= $cat_id ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-danger" name="delete_category">Yes,
                                                        Delete <i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete modal end  -->
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
                        <h5 class="fw-bold">No Categories record found!</h5>
                    </div>
                </div>
            </div>
        </main>
    <?php } ?>
<?php } ?>
<?php include 'partials/javascripts.php'; ?>
