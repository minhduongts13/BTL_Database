<?php
include 'connect.php';

$query = $_GET['query'] ?? '';

if ($query) {
    try {
        $stmt = $db->prepare("SELECT Ten_bai_hat FROM BAI_HAT WHERE Ten_bai_hat LIKE :query LIMIT 10");
        $stmt->execute(['query' => "%$query%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($results);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}
