<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 

$user_id = $_SESSION['user_id'];

// Query per ottenere le categorie con il numero di note per categoria e il tenant code
$FetchCategoriesDetailssql = "SELECT c.cat_id, c.cat_name, COUNT(n.note_id) AS num_notes 
                              FROM categories c
                              LEFT JOIN notes n ON c.cat_id = n.note_cat
                              WHERE c.tenant_code = (SELECT tenant_code FROM users WHERE user_id = $user_id)
                              GROUP BY c.cat_id
                              ORDER BY c.cat_name ASC";
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
                    $num_notes = $FetchCategoriesDetailsrow['num_notes'];
                    ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-secondary mb-0 fs-14 text-capitalize">
                                    <i class="bi bi-bookmark-fill"></i>
                                    <span class="fw-bold"><?= $cat_name ?></span>
                                </p>
                                <!-- Visualizza solo il numero di note -->
                                <p class="text-secondary fs-14 mb-0">
                                    <span class="fw-bold">notes:</span> <?= $num_notes ?>
                                </p>
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
