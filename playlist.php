<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: url('./assets/image/ass/back.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .banner img {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
    <?php include("auth.php") ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="homePage.php">🎶 Spoticon - Khám phá danh sách nhạc yêu thích của bạn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Playlist của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Thêm bài hát</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <img src="./assets/image/ass/grand.jpg" alt="Music Banner" style=" height: 500px; object-fit: cover;" class="img-fluid w-100">
    </div>

    <!-- Content -->
    <div class="container">
        <h1 class="text-primary mb-4">🎵Playlist của tôi</h1>
        <table class="table table-hover table-bordered bg-white shadow-sm text-dark">
            <thead class="table-primary">
                <tr>
                    <th>Ảnh bìa</th>
                    <th>Tên bài hát</th>
                    <th>Mô tả</th>
                    <th>Lượt nghe</th>
                    <th>Thời lượng</th>
                    <th>Phát</th>
                    <th>Xoá khỏi Playlist</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php'; // Kết nối CSDL
                $user_id = $_SESSION['user_id'];
                // Lấy danh sách bài hát từ CSDL
                $stmt = $db->prepare("SELECT * FROM BAI_HAT WHERE ID IN (SELECT ID_Bai_hat FROM BAI_HAT_THUOC_PLAYLIST WHERE ID_Playlist IN (SELECT ID FROM PLAYLIST WHERE ID_nguoi_dung = $user_id));");
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach ($result as $row){
                    echo ' 
                        <tr>
                            <td> <img src="./assets/image/ass/5.jpg" alt="Cover" style="width: 80px; height: 80px; object-fit: cover;" class="rounded"></td>
                            <td>'.$row['Ten_bai_hat'].'  </td>
                            <td>'.$row['Mo_ta_bai_hat'].' </td>
                            <td>'.$row['Luot_nghe'].' </td>
                            <td>'.$row['Thoi_luong'].' </td>
                            <td> <a href="song_page.php?id='.$row['ID'].'" target="_blank">Nghe</a></td>
                            <td>
                                <a href="delete.php?id='.$row['ID'].'" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </a>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
