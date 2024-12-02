<?php
    // Kết nối tới CSDL
    include 'connect.php';
    include("auth.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user_id'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        $type = $_POST['type'];
        $purchase = $_POST['purchase'];
        $voucherId = $_POST['Voucher'] ?: null;
        $priceMap = [
            'option1' => 50000,
            'option2' => 150000,
            'option3' => 200000,
        ];
        $basePrice = isset($priceMap[$type]) ? $priceMap[$type] : 0;
        try {
            $stmt = $db->prepare("CALL addSubscription(:userId, :startDate, :endDate, :type, :purchase, :basePrice, :voucherId)");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
            $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':purchase', $purchase, PDO::PARAM_STR);
            $stmt->bindParam(':basePrice', $basePrice, PDO::PARAM_INT);
            $stmt->bindParam(':voucherId', $voucherId, PDO::PARAM_INT);
            $stmt->execute();
            echo '<p class="text-white">Thuê bao của bạn đã được mua thành công!</p>';
        } catch (PDOException $e) {
            echo '<p class="text-white">Lỗi: "' . $e->getMessage() .'</p>';
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/user_account_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Spoticon</title>
    <style>
        /* Thêm khoảng trống phía trên phần tử tiếp theo của header */
        .content-container {
            padding-top: 100px; /* Điều chỉnh giá trị này theo chiều cao của header */
        }
    </style>
</head>
<body class="bg-black">
    <div class="content-container container my-5">
        <div class="card bg-dark text-white shadow-lg">
            <!-- Tiêu đề -->
            <div class="card-header bg-gradient bg-success text-uppercase text-center py-3">
                <h2 class="fw-bold mb-0">MUA THUÊ BAO PREMIUM</h2>
            </div>

            <!-- Nội dung -->
            <div class="card-body">
                <!-- Thuê bao hiện có -->
                <section class="mb-5">
                <form method="POST">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại thuê bao: </label>
                        <select id="type" name="type"> 
                            <option value="option1">Basic: 50000</option> 
                            <option value="option2">Standard: 150000</option> 
                            <option value="option3">Premium: 200000</option> 
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="purchase" class="form-label">Phương thức thanh toán: </label>
                        <select id="purchase" name="purchase"> 
                            <option value="option1">E-Wallet</option> 
                            <option value="option2">Bank Transfer</option> 
                            <option value="option3">Master Card</option> 
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Voucher" class="form-label">Mã Voucher</label>
                        <input type="number" class="form-control" id="Voucher" name="Voucher">
                    </div>
                    <button type="submit" class="btn btn-success">MUA</button>
                    <a href="user_account_page.php" class="btn btn-outline-light">Quay lại</a>
                </form>
                </section>

                
            </div>
        </div>
    </div>
    


</body>
</html>

