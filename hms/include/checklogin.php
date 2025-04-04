<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function check_login() {
    if (!isset($_SESSION['login'])) {
        header("Location: ../user-login.php");
        exit();
    }
}
?>
