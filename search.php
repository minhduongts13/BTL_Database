<?php
include 'connect.php';

if (isset($_GET['query'])) {
    $query = $_GET['query']; // Lấy từ khóa tìm kiếm từ biểu mẫu
    try {
        // Chuẩn bị câu truy vấn tìm kiếm
        $stmt = $db->prepare("
            SELECT * 
            FROM BAI_HAT
            WHERE Ten_tac_gia LIKE :query OR artist LIKE :query
            UNION
            SELECT 'album' AS type, title, artist 
            FROM albums 
            WHERE title LIKE :query OR artist LIKE :query
        ");
        
        $searchTerm = '%' . $query . '%'; // Thêm ký tự wildcard
        $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        
        // Lấy kết quả
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị kết quả
        echo '<div class="container text-white">';
        echo '<h2>Kết quả tìm kiếm cho: ' . htmlspecialchars($query) . '</h2>';
        if (count($results) > 0) {
            echo '<ul>';
            foreach ($results as $result) {
                $type = $result['type'] === 'song' ? 'Bài hát' : 'Album';
                echo '<li>' . htmlspecialchars($type) . ': ' . htmlspecialchars($result['title']) . ' - ' . htmlspecialchars($result['artist']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Không tìm thấy kết quả phù hợp.</p>';
        }
        echo '</div>';
    } catch (PDOException $e) {
        echo '<p class="text-danger">Lỗi: ' . $e->getMessage() . '</p>';
    }
} else {
    echo '<p class="text-warning">Vui lòng nhập từ khóa tìm kiếm.</p>';
}
?>


<div class="container text-white">
    <h2 class="mb-4">Kết quả tìm kiếm cho: <?= htmlspecialchars($query) ?></h2>
    <?php if (count($results) > 0): ?>
        <ul class="list-group">
            <?php foreach ($results as $result): ?>
                <li class="list-group-item bg-dark text-white">
                    <?= htmlspecialchars($result['type'] === 'song' ? 'Bài hát' : 'Album') ?>: 
                    <strong><?= htmlspecialchars($result['title']) ?></strong> 
                    - <?= htmlspecialchars($result['artist']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không tìm thấy kết quả phù hợp.</p>
    <?php endif; ?>
</div>
