<?php
include 'connect.php'; // Kết nối CSDL
include("auth.php");
// Kiểm tra nếu người dùng gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id']; // Lấy ID người dùng từ URL
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    try {
        // Gọi hàm MySQL changePassword
        $stmt = $db->prepare("SELECT changePassword(:id, :currentPassword, :newPassword, :confirmPassword) AS result");
        $stmt->execute([
            'id' => $id,
            'currentPassword' => $currentPassword,
            'newPassword' => $newPassword,
            'confirmPassword' => $confirmPassword
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Xử lý thông báo kết quả
        if ($result) {
            echo "<p>" . $result['result'] . "</p>";
        }
    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Đổi mật khẩu</title>
</head>
<body class="bg-black text-white">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đổi mật khẩu</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật mật khẩu</button>
            <a href="user_account_page.php?id=<?= $_GET['id'] ?>" class="btn btn-outline-light">Quay lại</a>
        </form>
    </div>
</body>
</html>
