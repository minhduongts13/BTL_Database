<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Premium</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-image: url('./ass/4.jpg'); background-size: cover; background-position: center; border-radius: 15px; padding: 20px;">
    <?php
    include 'connect.php'; // Kết nối CSDL
    $user_id = $_SESSION['id']; // ID người dùng truyền qua URL
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $loai_thue_bao = $_POST['loai_thue_bao'];
        $gia_goc = $_POST['gia_goc'];
        $thong_tin_thanh_toan = $_POST['thong_tin_thanh_toan'];
        $id_voucher = !empty($_POST['id_voucher']) ? $_POST['id_voucher'] : null;

        // Tính ngày bắt đầu và ngày kết thúc dựa trên loại thuê bao
        $ngay_bat_dau = date('Y-m-d'); // Ngày hiện tại
        $ngay_ket_thuc = date('Y-m-d', strtotime($ngay_bat_dau . ' + ' . ($loai_thue_bao == 'thang' ? '1 month' : '1 year')));

        try {
            // Chèn dữ liệu vào bảng THUE_BAO_PREMIUM
            $stmt = $db->prepare("INSERT INTO THUE_BAO_PREMIUM 
                (Ngay_bat_dau, Ngay_ket_thuc, Loai_thue_bao, Gia_goc, Thoi_gian_thanh_toan, Thong_tin_thanh_toan, ID_nguoi_dung, ID_voucher) 
                VALUES (:ngay_bat_dau, :ngay_ket_thuc, :loai_thue_bao, :gia_goc, NOW(), :thong_tin_thanh_toan, :id_nguoi_dung, :id_voucher)");

            $stmt->execute([
                'ngay_bat_dau' => $ngay_bat_dau,
                'ngay_ket_thuc' => $ngay_ket_thuc,
                'loai_thue_bao' => 'Premium',
                'gia_goc' => $gia_goc,
                'thong_tin_thanh_toan' => $thong_tin_thanh_toan,
                'id_nguoi_dung' => $user_id,
                'id_voucher' => $id_voucher
            ]);

            $success = "Bạn đã đăng ký Premium thành công!";
        } catch (PDOException $e) {
            $error = "Đã xảy ra lỗi khi xử lý yêu cầu. Vui lòng thử lại!";
        }
    }
    ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mua Premium</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php elseif (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="loai_thue_bao" class="form-label">Loại thuê bao:</label>
                <select id="loai_thue_bao" name="loai_thue_bao" class="form-select" required>
                    <option value="thang">Thuê bao tháng - 80.000VND</option>
                    <option value="nam">Thuê bao năm - 500.000VND</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gia_goc" class="form-label">Thanh toán giá gói Premium (VNĐ):</label>
                <input type="number" id="gia_goc" name="gia_goc" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="id_voucher" class="form-label">Mã giảm giá (tùy chọn):</label>
                <input type="text" id="id_voucher" name="id_voucher" class="form-control">
            </div>
            <div class="mb-3">
                <label for="thong_tin_thanh_toan" class="form-label">Thông tin thanh toán:</label>
                <textarea id="thong_tin_thanh_toan" name="thong_tin_thanh_toan" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng ký Premium</button>
        </form>
    </div>
</body>
</html>
