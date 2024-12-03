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
    <style>
        .background-img {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .card {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
        }
        .navbar {
            background-color: rgba(0, 123, 255, 0.8);
        }
        .form-label {
            color: white;
        }
        .btn {
            border-radius: 25px;
        }
        #suggestion-box {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<?php
    include 'connect.php';
    include('auth.php');
    $user_id= $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $error = ''; // Biến lưu thông báo lỗi
        
        try {
            // Kiểm tra bài hát có tồn tại không
            $checkSongStmt = $db->prepare("SELECT ID FROM BAI_HAT WHERE Ten_bai_hat = :title");
            $checkSongStmt->execute(['title' => $title]);
            $song = $checkSongStmt->fetch();

            if (!$song) {
                $error = "Bài hát '$title' không tồn tại. Vui lòng kiểm tra lại tên bài hát !";
            } else {
                // Kiểm tra playlist có tồn tại không
                $checkPlaylistStmt = $db->prepare("SELECT ID FROM PLAYLIST WHERE ID_nguoi_dung = :user_id");
                $checkPlaylistStmt->execute(['user_id' => $user_id]);
                $playlist = $checkPlaylistStmt->fetch();

                if (!$playlist) {
                    $error = "Playlist không tồn tại với người dùng hiện tại !";
                } else {
                    // Thêm bài hát vào playlist
                    $insertStmt = $db->prepare("INSERT INTO BAI_HAT_THUOC_PLAYLIST (ID_Bai_hat, ID_Playlist) VALUES (:song_id, :playlist_id)");
                    $insertStmt->execute([
                        'song_id' => $song['ID'],
                        'playlist_id' => $playlist['ID']
                    ]);
                    header("Location: playlist.php"); // Chuyển hướng sau khi thành công
                    exit;
                }
            }
        } catch (PDOException $e) {
            // Thông báo lỗi chung (tránh hiển thị lỗi SQL thô)
            $error = "Bài hát đã tồn tại trong Playlist của bạn. Vui lòng thử lại bài khác !";
        }
    }
    ?>
    <img src="assets/image/ass/add.jpg" alt="Background" class="background-img">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="playlist.php">🎶 Spoticon - Khám phá danh sách nhạc yêu thích của bạn</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3>Thêm bài hát mới</h3>
            </div>
            <div class="card-body">
                <!-- Hiển thị lỗi nếu có -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <strong>Lỗi!</strong> <strong><?= htmlspecialchars($error) ?><strong>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3 position-relative">
                        <label for="title" class="form-label">Tên bài hát:</label>
                        <input type="text" id="title" name="title" class="form-control" required autocomplete="off">
                        <div id="suggestion-box" class="list-group position-absolute w-100"></div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Thêm
                    </button>
                    <a href="playlist.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('title').addEventListener('input', function () {
            const query = this.value.trim();
            const suggestionBox = document.getElementById('suggestion-box');
            if (query.length > 1) {
                fetch(`search_songs.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionBox.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(song => {
                                const item = document.createElement('div');
                                item.className = 'list-group-item list-group-item-action';
                                item.textContent = song.Ten_bai_hat;
                                item.addEventListener('click', () => {
                                    document.getElementById('title').value = song.Ten_bai_hat;
                                    suggestionBox.innerHTML = '';
                                });
                                suggestionBox.appendChild(item);
                            });
                        }
                    })
                    .catch(err => console.error('Error fetching suggestions:', err));
            } else {
                suggestionBox.innerHTML = '';
            }
        });
    </script>
</body>
</html>
