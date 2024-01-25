<div class="row g-2 my-3">
    <h5 class="fw-bold">Related Notes :</h5>
    <?php
    $FetchNotesDetailssql = "SELECT * from notes INNER JOIN categories ON categories.cat_id = notes.note_cat INNER JOIN users ON users.user_id = notes.note_user where note_user != $userId AND note_privacy = 0 AND notes_status = 0 ORDER BY `notes`.`note_id` DESC LIMIT 4";
    $FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

    if ($FetchNotesDetailsresult->num_rows > 0) {
        while ($FetchNotesDetailsrow = $FetchNotesDetailsresult->fetch_assoc()) {
            // set data 
            $id = $FetchNotesDetailsrow['note_id'];
            $user = $FetchNotesDetailsrow['user_name'];
            $title = $FetchNotesDetailsrow['note_title'];
            $catName = $FetchNotesDetailsrow['cat_name'];
            $tags = $FetchNotesDetailsrow['note_tags'];
            $privacy = $FetchNotesDetailsrow['note_privacy'];
            $views = $FetchNotesDetailsrow['note_views'];
            $date = date("d M Y", strtotime($FetchNotesDetailsrow['note_date']));
            ?>
            <div class="col-6">
                <div class="card rounded-4">
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
                                <p class="text-secondary mb-0 fs-14">
                                    <i class="bi bi-person-fill"></i> By
                                    <?= $user ?>
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
            </div>
        </div>
        <?php
    } ?>

</div>