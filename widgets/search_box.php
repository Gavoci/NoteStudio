<div class="card my-4">
    <div class="card-body">
        <form action="php/user_searches_keywords.php" method="post" autocomplete="off">
            <div class="input-group">
                <input type="search" name="search" class="form-control" id="" placeholder="Search " required>
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
            </div>
        </form>
<?php
?>
    </div>
</div>
<?php 
include 'alert_message.php';

?>

