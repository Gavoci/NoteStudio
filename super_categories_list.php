<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 

// Query per ottenere le categorie
$FetchCategoriesDetailssql = "SELECT * FROM categories";
$FetchCategoriesDetailsresult = $conn->query($FetchCategoriesDetailssql);

if ($FetchCategoriesDetailsresult->num_rows > 0) {
    ?>
    <main>
        <div class="container my-4">
            <h5 class="fw-bold">Categories List</h5>
            <?php include 'widgets/alert_message.php'; ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <?php
                while ($FetchCategoriesDetailsrow = $FetchCategoriesDetailsresult->fetch_assoc()) {
                    // set data 
                    $cat_id = $FetchCategoriesDetailsrow['cat_id'];
                    $cat_name = $FetchCategoriesDetailsrow['cat_name'];
                    $cat_date = date("d M Y", strtotime($FetchCategoriesDetailsrow['cat_date']));
                    
                    // Ottieni il tenant code relativo alla categoria
                    $tenant_code = $FetchCategoriesDetailsrow['tenant_code'];
                    ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <p class="text-secondary mb-0 fs-14 text-capitalize">
                                        <i class="bi bi-bookmark-fill"></i>
                                        <span class="fw-bold"><?= $cat_name ?></span>
                                    </p>
                                    <p class="text-secondary fs-14 mb-0">
                                        <?= $cat_date ?>
                                    </p>
                                    <!-- Visualizza il tenant code sotto la data -->
                                    <p class="text-secondary fs-14 mb-0">
                                        <span class="fw-bold">Tenant Code:</span> <?= $tenant_code ?>
                                    </p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light border btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="edit_category.php?catId=<?= $cat_id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-<?= $cat_id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                    </ul>
                                </div>
                                <!-- Modal per eliminare -->
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
                                <!-- Fine modal -->
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
                    <h5 class="fw-bold">No Categories record found!</h5>
                </div>
            </div>
        </div>
    </main>
<?php } ?>
<?php include 'partials/javascripts.php'; ?>
