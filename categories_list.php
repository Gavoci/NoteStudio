<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; 

$FetchNotesDetailssql = "SELECT * from categories ORDER BY `categories`.`cat_name` ASC";
$FetchNotesDetailsresult = $conn->query($FetchNotesDetailssql);

    ?>
    <main>
        <div class="container my-4">
        <h6 class="fw-bold my-3">Categories</h6>
        <ul class="list-group list-group-numbered">
            <?php
            $FetchCategoriessql = "SELECT * from categories ORDER BY `categories`.`cat_name` ASC";
            $FetchCategoriesresult = $conn->query($FetchCategoriessql);
                
            if ($FetchCategoriesresult->num_rows > 0) {
                // Output data of each row
                while ($FetchCategoriesrow = $FetchCategoriesresult->fetch_assoc()) {
                    $catId = $FetchCategoriesrow["cat_id"];
                    $catName = $FetchCategoriesrow['cat_name'];
                        
                    // Get total notes for the category
                    $totalNotes = countNotesByCategoryId($catId);

                        ?>
                        <li class="list-group-item p-3 d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold text-capitalize">
                                    <a href="#" class="notesTitleLink">
                                        <?= $catName ?>
                                    </a>
                                </div>
                            </div>
                            <span class="">
                                <?= $totalNotes ?>
                            </span>
                        </li>
                        <?php
                }
            } else {
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">No Categories</div>
                    </div>
                </li>
                <?php
            }
                ?>
            </ul>  
        </div>
    </main>

<?php include 'partials/javascripts.php'; ?>