<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_regenerate_id(true);
session_unset();
session_destroy();

header("Location: ../views/Login.php");
exit();
?>
