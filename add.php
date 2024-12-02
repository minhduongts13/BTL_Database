<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài hát</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <?php include("auth.php") ?>
    <style>
        /* Đảm bảo ảnh nền bao phủ toàn bộ màn hình */
        .background-img {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /* Đảm bảo ảnh phủ đầy toàn bộ */
            z-index: -1; /* Đưa ảnh xuống dưới nội dung */
        }

        /* Cải tiến các phần tử với nền mờ */
        .card {
            background: rgba(0, 0, 0, 0.6); /* Nền mờ đen cho card */
            border-radius: 10px;
        }

        .navbar {
            background-color: rgba(0, 123, 255, 0.8); /* Màu navbar với độ trong suốt */
        }

        .form-label {
            color: white; /* Màu chữ cho nhãn */
        }

        .btn {
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <?php
    include 'connect.php';
    $user_id= $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        
        $stmt = $db->prepare("CALL AddSongToPlaylist(:user_id, :title);
                                    ");
        try {
            $stmt->execute(['user_id' => $user_id, 'title' => $title]);
            header("Location: playlist.php");
            exit;
        } catch (PDOException $e) {
            $error = "Lỗi: " . $e->getMessage();
        }
    }
    ?>
    <!-- Hình nền sử dụng thẻ <img> -->
    <img src="./assets/image/ass/add.jpg" alt="Background" class="background-img">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="homePage.php">🎶 Spoticon - Khám phá danh sách nhạc yêu thích của bạn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Playlist của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add.php">Thêm bài hát</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form -->
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3>Thêm bài hát mới</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tên bài hát:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Thêm
                    </button>
                    <a href="playlist.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
