<div class="container sticky-lg-top">
            <h5 class="fw-bold mb-4">Recent Notes </h5>
            <div class="row g-2">
                <?php
                $FetchNotesDetailssql = "SELECT * from notes INNER JOIN categories ON categories.cat_id = notes.note_cat where note_user = $userId ORDER BY `notes`.`note_id` DESC LIMIT 4";
                $FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

                if ($FetchNotesDetailsresult->num_rows > 0) {
                    while ($FetchNotesDetailsrow = $FetchNotesDetailsresult->fetch_assoc()) {
                        // set data 
                        $id = $FetchNotesDetailsrow['note_id'];
                        $title = $FetchNotesDetailsrow['note_title'];
                        $catName = $FetchNotesDetailsrow['cat_name'];
                        $views = $FetchNotesDetailsrow['note_views'];
                        $date = date("d M Y", strtotime($FetchNotesDetailsrow['note_date']));
                        ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <img src="assets/img/book1.png" alt="">
                                        </div>
                                        <div class="col-8">
                                            <a href="php/note_views.php?noteId=<?= $id ?>" class="notesTitleLink">
                                                <h6 class="fw-bold mb-0">
                                                    <?= $title ?>
                                                </h6>
                                            </a>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else {
                    ?>
                    <div class="card rounded-4 border shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">No Notes found !</h6>
                            <a href="new_notes.php" class="btn btn-primary btn-sm">Create Notes</a>
                        </div>
                    </div>
                    <?php
                } ?>

            </div>
        <!-- </div>
    </div> -->
</div>
