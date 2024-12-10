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
    <title>Đăng nhập</title>
    <?php 
    session_start();
    if (isset($_SESSION['user_id'])){
            header('Location: homePage.php');
    }
    ?>
</head>


<body class="bg-black">

    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>

    </div>

    <div id="song-description" class="container">
            
        <div class="card bg-dark text-white shadow-lg d-flex align-items-center justify-content-center vh-75">
            <h2>ĐĂNG NHẬP</h2>
            <form class="w-50" method="post" action="log_in.php">
                <div class="form-group mt-3">
                    <label for="username">Tên đăng nhập</label>
                    <?php
                    if (isset($_COOKIE["username"])) {
                        $username = $_COOKIE["username"];
                        echo "<input type='text' class='form-control' id='username' name='username' aria-describedby='emailHelp' value='$username'>";
                    } else
                    echo '
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Nhập tên đăng nhập của bạn">
                    ';
                    ?>
                </div>

                <div class="form-group mt-3">
                    <label for="password">Nhập mật khẩu</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu">
                </div>
                
                <div class="form-group form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ghi nhớ người dùng</label>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <a href="sign_up.php">
                <button class="btn btn-danger">Đăng ký</button>
                </a>
            </div>

            <div class="mt-3">
                <?php 
                    include 'connect.php';

                    if (isset($_POST['username']) && isset($_POST['pass'])) {
                        $username = $_POST['username'];
                        $password = $_POST['pass'];

                        if (isset($_POST["remember"])) {
                            $cookie_name = "username";
                            $cookie_value = $_POST["username"];
                            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");         
                        }
                        
                        try {
                            $stmt = $db->prepare("SELECT checkLogin(:username, :password) AS result");
                            $stmt->execute(['username' => $username, 'password' => $password]);
                            $result = $stmt->fetch();
                            $response = $result['result']; // Chuỗi dạng "trạng_thái:user_id"
                            list($status, $userId) = explode(':', $response);
                            if ($userId == 0) {
                                echo "<p>Sai tài khoản hoặc mật khẩu</p>";
                            } else {
                                session_start();
                                $_SESSION['username'] = $username;
                                $_SESSION['user_id'] = $userId;
                                header('Location: ../homePage.php');
                            }
                        } catch (PDOException $e) {
                            echo "Lỗi: " . $e->getMessage();
                        }
                    } else
                    echo "<div></div>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>