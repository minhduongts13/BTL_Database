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
