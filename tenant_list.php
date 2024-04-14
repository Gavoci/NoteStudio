<?php 
include 'partials/header.php';
include 'partials/navbar.php'; 

$user_id = $_SESSION['user_id'];

// Query per ottenere i tenant
$FetchTenantsDetailssql = "SELECT * FROM tenants";
$FetchTenantsDetailsresult = $conn->query($FetchTenantsDetailssql);

if ($FetchTenantsDetailsresult->num_rows > 0) {
    ?>
    <main>
        <style>
            .tenant-name:hover {
                text-decoration: underline;
            }
        </style>
        <div class="container my-4">
            <h5 class="fw-bold">Tenants List</h5>
            <?php include 'widgets/alert_message.php'; ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <?php
                while ($FetchTenantsDetailsrow = $FetchTenantsDetailsresult->fetch_assoc()) {
                    // set data 
                    $tenant_code = $FetchTenantsDetailsrow['tenant_code'];
                    $tenant_name = $FetchTenantsDetailsrow['tenant_name'];
                    ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-secondary mb-0 fs-14 text-capitalize">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-bold tenant-name"><?= $tenant_name ?></span>
                                </p>
                                 <!-- Visualizza il tenant code sotto il nome del tenant -->
                                 <p class="text-secondary fs-14 mb-0">
                                    <span class="fw-bold">Tenant Code:</span> <?= $tenant_code ?>
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
                    <h5 class="fw-bold">No Tenants record found!</h5>
                </div>
            </div>
        </div>
    </main>
<?php } ?>
<?php include 'partials/javascripts.php'; ?>
