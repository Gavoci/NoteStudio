<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NoteStudio";

header("Content-Type: application/json");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getTableData($table) {
    global $conn;
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

$table = $_GET['table'];

if ($table == 'categories' || $table == 'notes' || $table == 'users') {
    $responseData = getTableData($table);
    $output = array();
    $output['table'] = $table;
    $output['data'] = $responseData;
    echo json_encode($output, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('error' => 'Invalid table name'));
}

$conn->close();
?>
