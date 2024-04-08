<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>

    <div class="container my-4">

        <h5 class="fw-bold">Create new notes</h5>
        <div class="card">
            <div class="card-body">
                <?php include 'widgets/alert_message.php'; ?>

                <form action="php/upload_new_notes.php" method="post" class="row g-3" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="title">Category</label>
                        <select name="category" id="" class="form-control text-capitalize" required>
                            <option value="" selected hidden>Choose...</option>
                            <?php echo fetchCategoryNames($conn); ?>

                        </select>
                    </div>
                    <div class="col-12">
                        <label for="desc">Write Notes</label>
                        <textarea name="desc" id="inp_editor1" cols="30" rows="10" class="form-control"
                            required></textarea>
                    </div>
                    <div class="d-grid">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Install rick text editor  -->
<script src="assets/texteditor/all_plugins.js"></script>
<script src="assets/texteditor/rte.js"></script>
<script>
    var editor1 = new RichTextEditor("#inp_editor1");
</script>

<?php include 'partials/javascripts.php'; ?>
