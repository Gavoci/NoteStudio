<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchQuery = '%' . $_POST['search'] . '%';

    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_role, user_joined FROM users WHERE user_name LIKE ?");
    $stmt->bind_param('s', $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_joined = date("d M Y", strtotime($row['user_joined']));

            // Costruisci il markup HTML per ogni utente
            echo '<div class="col-12">';
            echo '<div class="card rounded-4 shadow-sm border">';
            echo '<div class="card-body">';
            echo '<div class="row align-items-center">';
            echo '<div class="col-md-12 col-lg-8">';
            echo '<p class="text-secondary mb-0 fs-14 text-capitalize">';
            echo '<i class="bi bi-person-fill"></i>';
            echo $user_name;
            echo '</p>';
            echo '<p class="text-secondary fs-14 mb-0">';
            echo $user_email;
            echo '</p>';
            echo '<p class="text-secondary fs-14 mb-0">';
            echo ($user_role == 1) ? 'Admin' : 'User';
            echo '</p>';
            echo '<p class="text-secondary fs-14 mb-0">';
            echo 'Joined on ' . $user_joined;
            echo '</p>';
            echo '</div>';
            // Aggiungi dropdown con le opzioni di edit e delete
            echo '<div class="col-lg-4 d-none d-lg-block">';
            echo '<div class="dropdown">';
            echo '<button class="btn btn-light border btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo 'Action';
            echo '</button>';
            echo '<ul class="dropdown-menu">';
            echo '<li><a class="dropdown-item" href="edit_user.php?userId=' . $user_id . '"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>';
            echo '<li><a class="dropdown-item delete-user" href="#" data-user-id="' . $user_id . '"><i class="bi bi-trash me-2"></i> Delete</a></li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12"><p class="text-secondary">No users found</p></div>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request';
}
?>
