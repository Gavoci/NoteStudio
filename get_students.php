<?php
include "config.php";

if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT * FROM `studente` WHERE `name` LIKE :searchTerm";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();
    
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
}
?>
