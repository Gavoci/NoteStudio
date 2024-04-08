<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php';

$noteId = $_GET['noteId'];
$FetchNotessql = "SELECT * FROM notes where note_id = $noteId";
$FetchNotesresult = $conn->query($FetchNotessql);

if ($FetchNotesresult->num_rows > 0) {
    // output data of each row
    while ($FetchNotesrow = $FetchNotesresult->fetch_assoc()) {
        // set data 
        $id = $FetchNotesrow['note_id'];
        $title = $FetchNotesrow['note_title'];
        $cat = $FetchNotesrow['note_cat'];
        $tags = $FetchNotesrow['note_tags'];
        $privacy = $FetchNotesrow['note_privacy'];
        $desc = $FetchNotesrow['note_desc'];
        $date = date("d M Y", strtotime($FetchNotesrow['note_date']));

        ?>

        <main>

            <div class="container my-4">

                <h5 class="fw-bold">Update Notes</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Update Note Details </h6>
                        <form action="php/update_notes.php" method="post" class="row g-3">
                            <input type="hidden" name="noteId" value="<?=$id?>">
                            <div class="col-12">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="" class="form-control" value="<?= $title ?>">
                            </div>
                            <div class="col-12">
                                <label for="title">Category</label>
                                <select name="category" id="" class="form-control text-capitalize">
                                    <option value="" selected hidden>Choose...</option>
                                    <?php echo fetchSelectedCategory($conn, $cat); ?>
                                </select>


                            </div>
                            <div class="col-12">
                                <label for="desc">Write Notes</label>
                                <textarea name="desc" id="inp_editor1" cols="30" rows="10"
                                    class="form-control"><?= $desc ?></textarea>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php
    }
} else {
    echo "Notes details not found !";
}
?>
<!-- create hashtags  -->
<script>
    document.getElementById('tags').addEventListener('input', function () {
        const tagsInput = document.getElementById('tags').value;
        const tagsArray = tagsInput.split(',');

        // Clear the existing hashtags
        document.getElementById('hashtags').innerHTML = '';

        // Loop through the tags, create hashtags, and append them to the container
        tagsArray.forEach(tag => {
            if (tag.trim() !== '') {
                const hashtag = document.createElement('span');
                hashtag.textContent = `#${tag.trim()} `;
                hashtag.classList.add('text-light', 'bg-primary', 'me-1', 'mb-1', 'fs-14', 'p-1',
                    'rounded-3');
                document.getElementById('hashtags').appendChild(hashtag);
            }
        });
    });
</script>
<!-- Install rick text editor  -->
<script src="assets/texteditor/all_plugins.js"></script>
<script src="assets/texteditor/rte.js"></script>
<script>
    var editor1 = new RichTextEditor("#inp_editor1");
</script>

<?php include 'partials/javascripts.php'; ?>
