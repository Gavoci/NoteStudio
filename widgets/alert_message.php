<?php
// Check if the session message and message type are set
if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
   $type = $_SESSION['type'];
   $message = $_SESSION['message'];
   // $icon = $_SESSION['icon'];
   ?>
   <div class="alert alert-<?= $type ?>" role="alert" id="alertMessage">
      <?php
      if ($type == 'success') {
         echo '<i class="bi bi-check-circle-fill"></i>';
      } else if ($type == 'danger') {
         echo '<i class="bi bi-exclamation-triangle-fill"></i>';
      }
      echo ' ' . $message;
      ?>
   </div>
   <?php
   // Unset or clear the session message and message type after displaying it
   unset($_SESSION['message']);
   unset($_SESSION['message_type']);
   unset($_SESSION['icon']);
}
?>