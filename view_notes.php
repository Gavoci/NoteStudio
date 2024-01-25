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
        $tags = $ViewNotesDetailsrow['note_tags'];
        $desc = $ViewNotesDetailsrow['note_desc'];
        $privacy = $ViewNotesDetailsrow['note_privacy'];
        $image = $ViewNotesDetailsrow['note_image'];
        $date = date("d M Y", strtotime($ViewNotesDetailsrow['note_date']));
        ?>
        <main>
            <div class="container my-4">
                <div class="row g-3">
                    <div class="col-lg-8 col-md-6">
                        <div class="card">
                            <?php
                            $image = $ViewNotesDetailsrow['note_image'];

                            if (!empty($image)) {
                                // If $image is not empty (not null or empty string), display the image
                                echo '<img src="assets/notesImages/' . $image . '" alt="Note Image" class="notesImage">';
                            }
                            ?>
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
                                <?php
                                // Assuming $tags contains fetched tags from the database
                                $tagsArray = preg_split('/,\s*/', $tags); // Split tags into an array by commas and optional spaces
                        
                                // Filter out empty tags (if any)
                                $tagsArray = array_filter($tagsArray, function ($value) {
                                    return !empty(trim($value));
                                });

                                $tagString = '#' . implode(' #', $tagsArray); // Add hashtags and join tags without commas
                        
                                echo '<p class="text-secondary"><i class="bi bi-tag-fill"></i> Tags: ' . $tagString . '</p>'; // Display the tags with hashtags without commas
                                ?>




                            </div>
                        </div>
                        <?php
                         include 'widgets/authorCard.php';
                        include 'widgets/recentNotes.php'; ?>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <?php include 'widgets/categories_widget.php'; ?>
                    </div>
                </div>

            </div>
        </main>

    <?php }
} else {
    echo "No data found !";
}

include 'partials/javascripts.php'; ?>