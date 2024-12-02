<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/advertisers.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Advertisers</title>
</head>


<body class="bg-black">

    <div>
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>
    </div>
    </div>

    <div id="song-description" class="container-fluid" style="margin-top: 7rem !important">            
        <div class="card bg-dark text-white shadow-lg align-items-center justify-content-center vh-75 mt-5">
            <?php 
                include '../connect.php';

                $username = $_POST['username'];
                $password = $_POST['pass'];
                
                try {
                    $stmt = $db->prepare("SELECT checkLogin(:username, :password) AS result");
                    $stmt->execute(['username' => $username, 'password' => $password]);
                    $result = $stmt->fetch();
                    $response = $result['result']; // Chuỗi dạng "trạng_thái:user_id"
                    list($status, $userId) = explode(':', $response);
                    if ($userId == 0) {
                        header("Location: ../log_in.php");
                        echo "<p>Sai tài khoản hoặc mật khẩu</p>";

                    } else {
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $userId;
                        header('Location: ../homePage.php');
                        echo "
                            <div class='d-flex align-items-center'>
                                <a href='../homePage.php'>
                                    <button class='btn btn-secondary'>Quay lại trang chủ</button>
                                </a>
                            </div>
                        ";
                    }
                } catch (PDOException $e) {
                    echo "Lỗi: " . $e->getMessage();
                }
                
            ?>
        </div>
    </div>
</body>
</html>