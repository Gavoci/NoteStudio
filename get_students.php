<?php
include 'config.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM studente";
if (!empty($search)) {
   $query .= " WHERE name LIKE '%$search%'";
}

$stmt = $conn->prepare($query);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($students as $student) {
   echo "<tr>
           <td>{$student['id']}</td>
           <td>{$student['name']}</td>
           <td>{$student['email']}</td>
           <td>{$student['user_type']}</td>
           <td>
              <button class='deleteBtn' data-id='{$student['id']}'>Elimina</button>
              <button class='editBtn' data-id='{$student['id']}'>Modifica</button>
           </td>
         </tr>";
}
?>
