<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM BAI_HAT_THUOC_PLAYLIST WHERE ID_Bai_hat = $id");
    try {
        $stmt->execute();
        header("Location: playlist.php");
    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}
?>

