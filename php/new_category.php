<?php
session_start();

include("../config.php"); // Include your database connection or configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se l'utente è loggato e ha il tenant_code associato
    if (isset($_SESSION['user_id'])) {
        // Recupera l'id utente dalla sessione
        $userId = $_SESSION['user_id'];
        
        // Recupera il tenant_code dell'utente dal database
        $stmt_get_tenant = $conn->prepare("SELECT tenant_code FROM users WHERE user_id = ?");
        $stmt_get_tenant->bind_param('i', $userId);
        $stmt_get_tenant->execute();
        $result_tenant = $stmt_get_tenant->get_result();
        
        if ($result_tenant->num_rows > 0) {
            $row_tenant = $result_tenant->fetch_assoc();
            $tenantCode = $row_tenant['tenant_code'];

            $categoryName = $_POST['categoryName'];
            
            // Controlla se il nome della categoria esiste già per il tenant
            $stmt_check = $conn->prepare("SELECT * FROM categories WHERE cat_name = ? AND tenant_code = ?");
            $stmt_check->bind_param('ss', $categoryName, $tenantCode);
            $stmt_check->execute();
            $result = $stmt_check->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['message'] = "Category <b>".$categoryName."</b> already exists!";
                $_SESSION['type'] = "danger";
            } else {
                // Prepara ed esegui la query SQL per inserire una nuova categoria nel database
                $stmt_insert = $conn->prepare("INSERT INTO categories (cat_name, tenant_code) VALUES (?, ?)");
                $stmt_insert->bind_param('ss', $categoryName, $tenantCode);
                
                if ($stmt_insert->execute()) {
                    $_SESSION['message'] = "Category <b>".$categoryName."</b> added successfully!";
                    $_SESSION['type'] = "success";
                } else {
                    $_SESSION['message'] = "Failed to add category!";
                    $_SESSION['type'] = "danger";
                }
                
                $stmt_insert->close(); // Chiudi il prepared statement dopo l'esecuzione
            }

            $stmt_check->close(); // Chiudi il prepared statement per il controllo dell'esistenza della categoria
        } else {
            $_SESSION['message'] = "User not found!";
            $_SESSION['type'] = "danger";
        }

        $stmt_get_tenant->close(); // Chiudi il prepared statement per ottenere il tenant_code

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['message'] = "You are not logged in!";
        $_SESSION['type'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
