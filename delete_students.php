<?php
include "config.php";

$id = $_GET["id"];

try {
    $stmt = $conn->prepare("DELETE FROM `studente` WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: index.php?msg=Data deleted successfully");
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
?>
