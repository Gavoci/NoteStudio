<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; 

$FetchNotesDetailssql = "SELECT * from notes INNER JOIN categories ON categories.cat_id = notes.note_cat where note_user = $userId AND notes_status = 0 ORDER BY `notes`.`note_id` DESC";
$FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

if ($FetchNotesDetailsresult->num_rows > 0) {

    ?>
    <main>
        <div class="container my-4">
        <?php include 'widgets/search_box.php'; ?>
            
            <h5 class="fw-bold">Notes List</h5>
            <div class="row g-3">
                <?php
                while ($FetchNotesDetailsrow = $FetchNotesDetailsresult->fetch_assoc()) {
                    // set data 
                    $id = $FetchNotesDetailsrow['note_id'];
                    $title = $FetchNotesDetailsrow['note_title'];
                    $catName = $FetchNotesDetailsrow['cat_name'];
                    $tags = $FetchNotesDetailsrow['note_tags'];
                    $views = $FetchNotesDetailsrow['note_views'];
                    $date = date("d M Y", strtotime($FetchNotesDetailsrow['note_date']));
                    ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-12 col-lg-1">
                                        <img src="assets/img/book1.png" alt="">
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <a href="php/note_views.php?noteId=<?= $id ?>" class="notesTitleLink">
                                            <h6 class="fw-bold mb-0 text-capitalize">
                                                <?= $title ?>
                                            </h6>
                                        </a>
                                        <p class="text-secondary mb-0 fs-14 text-capitalize"><i class="bi bi-bookmark-fill"></i>
                                            <?= $catName ?>
                                        </p>
                                        <?php
                                            if ($views > 0) {
                                                ?>
                                                <p class="text-secondary fs-14 mb-0"><i class="bi bi-eye-fill"></i>
                                                    <?= $views ?>
                                                    Views
                                                </p>
                                                <?php
                                            }

                                            ?>
                                        <p class="text-secondary fs-14 mb-0">
                                            <?= $date ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 d-none d-lg-block">
                                        <div class="dropdown">
                                            <button class="btn btn-light border btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="edit_notes.php?noteId=<?=$id?>"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-<?= $id ?>"><i class="bi bi-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- delete modal  -->
                                    <div class="modal fade" id="deleteModal-<?= $id ?>" tabindex="-1"
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
                                                        <?= $title ?>
                                                    </b>.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light border"
                                                        data-bs-dismiss="modal">No, Keep it.</button>
                                                    <form action="php/delete_note.php" method="post">
                                                        <input type="hidden" name="noteId" value="<?= $id ?>">
                                                        <input type="hidden" name="status" value="1">
                                                        <button type="submit" class="btn btn-danger" name="delete_note">Yes,
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

<?php } else {
    ?>
    <main>
        <div class="container my-4">
            <div class="card rounded-4 border shadow-sm">
                <div class="card-body text-center">
                    <h5 class="fw-bold">No Notes record found !</h5>
                </div>
            </div>
        </div>
    </main>
    <?php
} ?>
<?php include 'partials/javascripts.php'; ?>