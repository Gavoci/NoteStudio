<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>
    <div class="container my-4">

        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold">Add New Category</h5>
                <?php include 'widgets/alert_message.php'; ?>
                <form action="php/new_category.php" class="row g-3" method="post">
                    <div class="col-12">
                        <input type="text" name="categoryName" placeholder="Enter Category Name" id=""
                            class="form-control text-capitalize">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'partials/javascripts.php'; ?>