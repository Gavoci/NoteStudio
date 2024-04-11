<?php
session_start();

include("../config.php"); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenantCode = $_POST['tenantCode'];
    $tenantName = $_POST['tenantName'];

    // Validate tenant code length
    if (strlen($tenantCode) != 5) {
        $_SESSION['message'] = "Tenant code must be exactly 5 characters!";
        $_SESSION['type'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Check if tenant already exists
    $stmt_check = $conn->prepare("SELECT * FROM tenants WHERE tenant_code = ?");
    $stmt_check->bind_param('s', $tenantCode);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Tenant <b>".$tenantCode."</b> already exists!";
        $_SESSION['type'] = "danger";
    } else {
        // Insert new tenant into the database
        $stmt_insert = $conn->prepare("INSERT INTO tenants (tenant_code, tenant_name) VALUES (?, ?)");
        $stmt_insert->bind_param('ss', $tenantCode, $tenantName);
        
        if ($stmt_insert->execute()) {
            $_SESSION['message'] = "Tenant <b>".$tenantCode."</b> added successfully!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to add tenant!";
            $_SESSION['type'] = "danger";
        }
        
        $stmt_insert->close();
    }

    $stmt_check->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
