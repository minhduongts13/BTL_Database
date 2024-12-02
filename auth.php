<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa đăng nhập, chuyển hướng về login
    header('Location: log_in.php');
    exit;
}
?>
