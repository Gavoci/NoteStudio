<?php include 'partials/header.php';
include 'partials/navbar.php'; ?>
<main style="margin-top: 5rem;">
    <section>
        <div class="container my-4">
            <div class="row g-3">
                <div class="col-lg-8 col-md-6">
                    <?php include 'widgets/recentNotes.php'; ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <?php include 'widgets/categories_widget.php'; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include 'partials/javascripts.php'; ?>
