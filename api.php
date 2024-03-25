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

function getTableData($table, $idName, $id = null) {
    global $conn;
    $idName = $conn->real_escape_string($idName);
    if ($id !== null) {
        $sql = "SELECT * FROM $table WHERE $idName = $id";
    } else {
        $sql = "SELECT * FROM $table";
    }
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
$id = isset($_GET['id']) ? $_GET['id'] : null;
$idName = null;

// Mapping tra i nomi delle tabelle e i nomi degli ID
$idNamesMap = [
    'categories' => 'cat_id',
    'notes' => 'note_id',
    'users' => 'user_id'
];

if (array_key_exists($table, $idNamesMap)) {
    $idName = $idNamesMap[$table];
} else {
    echo json_encode(array('error' => 'Invalid table name'));
    exit;
}

if ($table == 'categories' || $table == 'notes' || $table == 'users') {
    $responseData = getTableData($table, $idName, $id);
    $output = array();
    $output['table'] = $table;
    $output['data'] = $responseData;
    echo json_encode($output, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('error' => 'Invalid table name'));
}

$conn->close();
?>
