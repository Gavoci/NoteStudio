<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CRUD studente</title>
</head>

<body>

    <div class="container">
        <form method="post" id="searchForm" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" name="searchTerm" id="searchTerm" placeholder="Cerca per nome">
                <button type="submit" class="btn btn-primary" name="search">Cerca</button>
            </div>
        </form>

        <table class="table table-hover text-center" id="studentTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">email</th>
                    <th scope="col">password</th>
                    <th scope="col">name</th>
                    <th scope="col">user_type</th>
                    <th scope="col">n. note</th>
                    <th scope="col">n. categorie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `studente`";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["password"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["user_type"] ?></td>
                    <td><?php echo $row["n_note"] ?></td>
                    <td><?php echo $row["n_categorie"] ?></td>
                    <td>
                        <a href="edit_students.php?id=<?php echo $row["id"] ?>"
                            class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="delete_students.php?id=<?php echo $row["id"] ?>"
                            class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Funzione per caricare la tabella degli studenti tramite AJAX
            function loadStudentTable(searchTerm = '') {
                $.ajax({
                    url: 'get_students.php',
                    method: 'POST',
                    data: {
                        search: true,
                        searchTerm: searchTerm
                    },
                    success: function (data) {
                        $('#studentTable tbody').html(data);
                    }
                });
            }

            // Carica la tabella degli studenti all'avvio della pagina
            loadStudentTable();

            // Gestisci la sottomissione del modulo di ricerca tramite AJAX
            $('#searchForm').submit(function (e) {
                e.preventDefault();
                var searchTerm = $('#searchTerm').val();
                loadStudentTable(searchTerm);
            });
        });
    </script>

</body>

</html>
