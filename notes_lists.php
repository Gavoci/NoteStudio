<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; 

$userId = $_SESSION['user_id']; // Assicurati di avere definito $userId
$FetchNotesDetailssql = "SELECT * FROM notes 
    INNER JOIN categories ON categories.cat_id = notes.note_cat 
    WHERE note_user = $userId AND notes.tenant_code = 
    (SELECT tenant_code FROM users WHERE user_id = $userId) 
    ORDER BY notes.note_id DESC";
$FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

if ($FetchNotesDetailsresult->num_rows > 0) {
    ?>
    <main>
        <div class="container my-4">
            <h5 class="fw-bold">Notes List</h5>
            <?php include 'widgets/alert_message.php'; ?>
            <div class="row g-3">
                <?php
                while ($FetchNotesDetailsrow = $FetchNotesDetailsresult->fetch_assoc()) {
                    $id = $FetchNotesDetailsrow['note_id'];
                    $title = $FetchNotesDetailsrow['note_title'];
                    $catName = $FetchNotesDetailsrow['cat_name'];
                    $views = $FetchNotesDetailsrow['note_views'];
                    $date = date("d M Y", strtotime($FetchNotesDetailsrow['note_date']));
                    ?>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <img src="assets/img/book1.png" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a href="php/note_views.php?noteId=<?= $id ?>" class="notesTitleLink">
                                                    <h6 class="fw-bold mb-0 text-capitalize">
                                                        <?= $title ?>
                                                    </h6>
                                                </a>
                                                <p class="text-secondary mb-0 fs-14 text-capitalize"><i class="bi bi-bookmark-fill"></i>
                                                    <?= $catName ?>
                                                </p>
                                                <p class="text-secondary fs-14 mb-0"><i class="bi bi-eye-fill"></i>
                                                    <?= $views ?> Views
                                                </p>
                                                <p class="text-secondary fs-14 mb-0">
                                                    <?= $date ?>
                                                </p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light border btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="edit_notes.php?noteId=<?= $id ?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delete modal -->
                        <div class="modal fade" id="deleteModal-<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"><i class="bi bi-exclamation-triangle-fill"></i> Are you sure?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        This action <b>CANNOT</b> be undone. This will permanently delete the <b><?= $title ?></b>.
                                    </div>
                                    <div class="modal-footer">
                                        <button type of="button" class="btn btn-light border" data-bs-dismiss="modal">No, Keep it.</button>
                                        <form action="php/delete_note.php" method="post">
                                            <input type="hidden" name="noteId" value="<?= $id ?>">
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-danger" name="delete_note">Yes, Delete <i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- delete modal end -->
                    </div>

                <?php } ?>

            </div>
        </div>
    </main>

<?php } else {
    ?>
    <main>
        <div class="container my-4">
            <div class="card rounded-4 border shadow-sm">
                <div the="card-body text-center">
                    <h5 class="fw-bold">No Notes record found !</h5>
                </div>
            </div>
        </div>
    </main>
    <?php
} ?>
<?php include 'partials/javascripts.php'; ?>
