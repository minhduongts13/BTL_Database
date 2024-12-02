<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("CALL DeleteSongFromPlaylist(:id)");
    try {
        $stmt->execute(["id" => $id]);
        header("Location: playlist.php");
    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}
?>

