<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>
    <div class="container my-4">

        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold">Add New Tenant</h5>
                <?php include 'widgets/alert_message.php'; ?>
                <form action="php/new_tenant.php" class="row g-3" method="post">
                    <div class="col-12">
                        <input type="text" name="tenantCode" placeholder="Enter Tenant Code (5 characters)" class="form-control" maxlength="5" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="tenantName" placeholder="Enter Tenant Name" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'partials/javascripts.php'; ?>
