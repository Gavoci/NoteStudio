<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>
<?php
$noteId = $_GET['noteId'];
$ViewNotesDetailssql = "SELECT * from notes INNER JOIN categories ON categories.cat_id = notes.note_cat where note_id = $noteId";
$ViewNotesDetailsresult = $conn->query($ViewNotesDetailssql);
if ($ViewNotesDetailsresult->num_rows > 0) {
    while ($ViewNotesDetailsrow = $ViewNotesDetailsresult->fetch_assoc()) {
        $id = $ViewNotesDetailsrow['note_id'];
        $noteUser = $ViewNotesDetailsrow['note_user'];
        $title = $ViewNotesDetailsrow['note_title'];
        $catName = $ViewNotesDetailsrow['cat_name'];
        $desc = $ViewNotesDetailsrow['note_desc'];
        $date = date("d M Y", strtotime($ViewNotesDetailsrow['note_date']));
        ?>
        <main>
            <div class="container my-4">
                <div class="row g-3">
                    <div class="col-lg-8 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="fw-bold text-capitalize display-6 my-4">Title :
                                    <?= $title ?>
                                </h5>
                                <h6 class="text-capitalize"><i class="bi bi-bookmark-check-fill"></i> Category :
                                    <?= $catName ?>
                                </h6>
                                <p class="text-secondary">
                                    <?= $date ?>
                                </p>
                                <div class="card-text">
                                    <?= $desc ?>
                                </div>
                            </div>
                        </div>
                        <?php
                         include 'widgets/authorCard.php'; ?>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    </div>
                </div>

            </div>
        </main>

    <?php }
} else {
    echo "No data found !";
}

include 'partials/javascripts.php'; ?>
