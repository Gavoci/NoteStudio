<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>
    <div class="container my-4">
        <h6 class="fw-bold my-3">Tenants</h6>
        <ul class="list-group list-group-numbered">
            <?php
            $FetchTenantssql = "SELECT * FROM tenants ORDER BY `tenant_name` ASC";
            $FetchTenantsresult = $conn->query($FetchTenantssql);

            if ($FetchTenantsresult->num_rows > 0) {
                // Output data of each row
                while ($row = $FetchTenantsresult->fetch_assoc()) {
                    $tenantCode = $row["tenant_code"];
                    $tenantName = $row['tenant_name'];
                    ?>
                    <li class="list-group-item p-3 d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold text-capitalize">
                                <?= $tenantName ?>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">
                            <?= $tenantCode ?>
                        </span>
                    </li>
                    <?php
                }
            } else {
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">No Tenants Found</div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>  
    </div>
</main>

<?php include 'partials/javascripts.php'; ?>
