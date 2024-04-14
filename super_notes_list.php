<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 

// Query per ottenere le note
$FetchNotesDetailssql = "SELECT * FROM notes";
$FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

if ($FetchNotesDetailsresult->num_rows > 0) {
?>
<main>
    <div class="container my-4">
        <h5 class="fw-bold">Notes Grid</h5>
        <?php include 'widgets/alert_message.php'; ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php
            while ($FetchNotesDetailsrow = $FetchNotesDetailsresult->fetch_assoc()) {
                // set data 
                $id = $FetchNotesDetailsrow['note_id'];
                $title = $FetchNotesDetailsrow['note_title'];
                $views = $FetchNotesDetailsrow['note_views'];
                $date = date("d M Y", strtotime($FetchNotesDetailsrow['note_date']));
                $tenant_code = $FetchNotesDetailsrow['tenant_code']; // Codice tenant
                $category_id = $FetchNotesDetailsrow['note_cat'];

                // Query per ottenere il nome della categoria
                $categoryQuery = "SELECT cat_name FROM categories WHERE cat_id = '$category_id'";
                $categoryResult = $conn->query($categoryQuery);
                $categoryName = ($categoryResult->num_rows > 0) ? $categoryResult->fetch_assoc()['cat_name'] : 'No Category';

                ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-4">
                                        <img src="assets/img/book1.png" alt="">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <a href="php/note_views.php?noteId=<?= $id ?>" class="notesTitleLink">
                                            <h6 class="fw-bold mb-0 text-capitalize">
                                                <?= $title ?>
                                            </h6>
                                        </a>
                                        <p class="text-secondary fs-14 mb-0"><i class="bi bi-eye-fill"></i>
                                            <?= $views ?> View<?= $views == 1 ? '' : 's' ?>
                                        </p>
                                        <p class="text-secondary fs-14 mb-0">
                                            <strong><i class="bi bi-bookmark-fill"></i></strong> <?= $categoryName ?>
                                        </p>
                                        <p class="text-secondary fs-14 mb-0">
                                            <?= $date ?>
                                        </p>
                                        <div class="d-flex align-items-center" style="width: 100%"> <!-- Aggiunto lo stile per la larghezza fissa -->
                                            <p class="text-secondary fs-14 mb-0 me-2" style="white-space: nowrap;"><strong>Tenant Code:</strong></p> <!-- Codice tenant -->
                                            <p class="text-secondary fs-14 mb-0" style="white-space: nowrap;"><?= $tenant_code ?></p> <!-- Imposta il tenant code per non andare a capo -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown per le azioni -->
                            <div class="dropdown">
                                <button class="btn btn-light border btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="edit_notes.php?noteId=<?= $id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                            <!-- delete modal  -->
                            <div class="modal fade" id="deleteModal-<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"> <i class="bi bi-exclamation-triangle-fill"></i> Are you sure ? </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            This action <b>CANNOT</b> be undone. This will permanently delete the <b><?= $title ?></b>.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">No, Keep it.</button>
                                            <form action="php/delete_note.php" method="post">
                                                <input type="hidden" name="noteId" value="<?= $id ?>">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-danger" name="delete_note">Yes, Delete <i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- delete modal end  -->
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
                <h5 class="fw-bold">No Notes record found !</h5>
            </div>
        </div>
    </div>
</main>
<?php } ?>
<?php include 'partials/javascripts.php'; ?>
