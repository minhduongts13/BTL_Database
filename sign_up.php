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

    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>
    </div>

    <div id="song-description" class="container">
            
        <div class="card bg-dark text-white shadow-lg d-flex align-items-center justify-content-center vh-75">
            <h2>ĐĂNG KÝ</h2>
            <form class="w-25" method="post" action="sign_in/signUpAction.php">
                <div class="form-group mt-3">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Nhập tên đăng nhập của bạn">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Nhập mật khẩu</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="pass_reentered" name="repass" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Đăng kí</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>