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

<script>
    function toggle() {
        const filterButton =document.querySelector("#filter_button");
        if (filterButton.innerHTML === "Chỉ xem các hợp đồng có hiệu lực") {
            filterButton.innerHTML = "Xem tất cả các hợp đồng";
        } else {
            filterButton.innerHTML = "Chỉ xem các hợp đồng có hiệu lực";
        }
    }
</script>

<body class="bg-black">

    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="home_page.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>

        <!-- Thanh tìm kiếm -->
        <form class="d-flex flex-grow-1" role="search">
            <input id="Search" 
                class="form-control me-2 rounded-pill border-0 shadow-sm" 
                type="search" 
                placeholder="Tìm kiếm bài hát, nghệ sĩ..." 
                aria-label="Search" 
                style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
            <button class="btn btn-success rounded-pill px-4" type="submit">Tìm kiếm</button>
        </form>

        <!-- Các nút chức năng -->
        <div class="ms-4 d-flex gap-3">
            <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Thể loại</button>
            <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Playlist của tôi</button>
            <a href="user_account_page.php">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Tài khoản của tôi</button>
            </a>
        </div>
    </div>

    <div id="song-description" class="container">
            
        <div class="card bg-dark text-white shadow-lg d-flex align-items-center justify-content-center vh-75">
            <h2>ĐĂNG NHẬP</h2>
            <form class="w-25">
                <div class="form-group mt-3">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Nhập tên đăng nhập của bạn">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Nhập mật khẩu</label>
                    <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Ghi nhớ người dùng</label>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>

            <div class="d-flex align-items-center justify-content-center mt-3">
                <a href="">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>