<?php
include "config.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $user_type = $_POST['user_type'];

    try {
        $stmt = $conn->prepare("UPDATE `studente` SET `email` = :email, `name` = :name, `user_type` = :user_type WHERE id = :id");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':user_type', $user_type);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: index.php?msg=Data updated successfully");
        exit(); // Assicura che lo script termini dopo il reindirizzamento
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }
}

// Ottieni i dati dello studente per il rendering del form
try {
    $stmt = $conn->prepare("SELECT * FROM `studente` WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">email:</label>
            <input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>">
          </div>

          <div class="col">
            <label class="form-label">name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
          </div>
        </div>

        <div class="form-group mb-3">
          <label>user type:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="user_type" id="user" value="user" <?php echo ($row["user_type"] == 'user') ? "checked" : ""; ?>>
          <label for="user" class="form-input-label">user</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="user_type" id="admin" value="admin" <?php echo ($row["user_type"] == 'admin') ? "checked" : ""; ?>>
          <label for="admin" class="form-input-label">admin</label>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
