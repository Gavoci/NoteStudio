<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>
    <div class="container my-4">

        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold">Update Category</h5>
                <?php include 'widgets/alert_message.php'; ?>
                <?php
                // Verifica se è stato passato un ID categoria tramite GET
                if (isset($_GET['catId'])) {
                    $catId = $_GET['catId'];

                    // Recupera i dettagli della categoria dal database
                    $sql = "SELECT * FROM categories WHERE cat_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $catId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $categoryName = $row['cat_name'];
                ?>
                        <form action="php/update_category.php" class="row g-3" method="post">
                            <div class="col-12">
                                <input type="hidden" name="catId" value="<?= $catId ?>">
                                <input type="text" name="categoryName" value="<?= $categoryName ?>" class="form-control text-capitalize" required>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Update Category</button>
                            </div>
                        </form>
                <?php
                    } else {
                        echo '<p class="text-danger">Category not found!</p>';
                    }
                    $stmt->close();
                } else {
                    echo '<p class="text-danger">Category ID not provided!</p>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php include 'partials/javascripts.php'; ?>
