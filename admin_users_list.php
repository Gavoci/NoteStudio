<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>

<main>
    <div class="container my-4">
        <?php include 'widgets/search_box_utenti.php'; ?>
        <h5 class="fw-bold">Users List</h5>
        <div class="row g-3" id="userListContainer">
            <?php
            if (isset($_POST['search']) && !empty($_POST['search'])) {
                // Se è stata effettuata una ricerca, mostra solo gli utenti corrispondenti
                include 'php/user_search_ajax.php';
            } else {
                // Se non c'è stata ancora nessuna ricerca, mostra l'intera lista di utenti
                $FetchUsersDetailssql = "SELECT user_id, user_name, user_email, user_role, user_joined FROM users";
                $FetchUsersDetailsresult = $conn->query($FetchUsersDetailssql);

                if ($FetchUsersDetailsresult) {
                    while ($FetchUsersDetailsrow = $FetchUsersDetailsresult->fetch_assoc()) {
                        // Costruisci il markup HTML per ogni utente direttamente qui
                        echo '<div class="col-12">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<div class="row align-items-center">';
                        echo '<div class="col-md-12 col-lg-8">';
                        echo '<p class="text-secondary mb-0 fs-14 text-capitalize">';
                        echo '<i class="bi bi-person-fill"></i>';
                        echo $FetchUsersDetailsrow['user_name'];
                        echo '</p>';
                        echo '<p class="text-secondary fs-14 mb-0">';
                        echo $FetchUsersDetailsrow['user_email'];
                        echo '</p>';
                        echo '<p class="text-secondary fs-14 mb-0">';
                        echo ($FetchUsersDetailsrow['user_role'] == 1) ? 'Admin' : 'User';
                        echo '</p>';
                        echo '<p class="text-secondary fs-14 mb-0">';
                        echo 'Joined on ' . date("d M Y", strtotime($FetchUsersDetailsrow['user_joined']));
                        echo '</p>';
                        echo '</div>';
                        // Aggiungi dropdown con le opzioni di edit e delete
                        echo '<div class="col-lg-4 d-none d-lg-block">';
                        echo '<div class="dropdown">';
                        echo '<button class="btn btn-light border btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        echo 'Action';
                        echo '</button>';
                        echo '<ul class="dropdown-menu">';
                        echo '<li><a class="dropdown-item" href="edit_user.php?userId=' . $FetchUsersDetailsrow['user_id'] . '"><i class="bi bi-pencil-square me-2"></i> Edit</a></li>';
                        echo '<li><a class="dropdown-item delete-user" href="#" data-user-id="' . $FetchUsersDetailsrow['user_id'] . '"><i class="bi bi-trash me-2"></i> Delete</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12"><p class="text-secondary">Error fetching users</p></div>';
                }
            }
            ?>
        </div>
    </div>
</main>

<?php include 'partials/javascripts.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Funzione per gestire la ricerca utenti tramite AJAX
        function searchUsers(query) {
            $.ajax({
                url: 'php/user_search_ajax.php',
                type: 'POST',
                data: { search: query },
                success: function(response) {
                    $('#userListContainer').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Gestisce la ricerca quando viene inviato il modulo di ricerca
        $('form#userSearchForm').submit(function(event) {
            event.preventDefault();
            var searchQuery = $('input[name="search"]').val();
            searchUsers(searchQuery);
        });
    });

    // Gestisce l'eliminazione dell'utente tramite AJAX
$('.delete-user').click(function(event) {
    event.preventDefault();
    var userId = $(this).data('user-id');
    var userContainer = $(this).closest('.col-12');  // Ottieni il contenitore dell'utente

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: 'php/delete_user_ajax.php',
            type: 'POST',
            data: { userId: userId },
            success: function(response) {
                if (response === 'success') {
                    // Rimuovi visivamente l'utente dalla lista
                    userContainer.fadeOut('fast', function() {
                        $(this).remove();
                    });
                } else {
                    console.error('Error deleting user');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});


</script>
