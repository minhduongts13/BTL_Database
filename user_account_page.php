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
    <title>The band</title>
</head>
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
        <div class="card text-white bg-dark shadow-lg">
            <!-- Tiêu đề -->
            <div class="card-header bg-success bg-gradient text-uppercase text-center py-2">
                <h2 class="fw-bold mb-0">Quản lý tài khoản</h2>
            </div>

            <!-- Nội dung -->
            <div class="card-body">
                <!-- Ảnh đại diện -->
                <div class="text-center mb-4">
                    <img src="./assets/image/content/avatar.jpg" alt="Avatar" class="rounded-circle img-thumbnail border border-light" style="width: 130px; height: 130px; object-fit: cover;">
                    <br>
                    <button class="btn btn-danger btn-md mt-2">Đổi ảnh đại diện</button>
                </div>

                <!-- Form thông tin -->
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="lastName" class="form-label fw-bold">Họ:</label>
                            <input type="text" id="lastName" class="form-control" value="Nguyễn Văn">
                        </div>
                        <div class="col-md-6">
                            <label for="firstName" class="form-label fw-bold">Tên:</label>
                            <input type="text" id="firstName" class="form-control" value="B">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Tên đăng nhập:</label>
                        <input type="text" id="username" class="form-control" value="nguyenvanb123">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Mật khẩu:</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" value="********">
                            <button type="button" class="btn btn-outline-danger">Đổi mật khẩu</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label fw-bold">Ngày sinh:</label>
                        <input type="date" id="dob" class="form-control" value="2000-11-01">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Địa chỉ:</label>
                        <input type="text" id="address" class="form-control" value="Việt Nam">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email:</label>
                        <div class="input-group">
                            <input type="email" id="email" class="form-control" value="nguyenvanb@gmail.com">
                            <button type="button" class="btn btn-outline-danger">Đổi Email liên kết</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Số điện thoại:</label>
                        <div class="input-group">
                            <input type="tel" id="phone" class="form-control" value="0123456789">
                            <button type="button" class="btn btn-outline-danger">Đổi số điện thoại</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Số điện thoại:</label>
                        <div class="input-group">
                            <input type="tel" id="phone" class="form-control" value="0123456789">
                            <button type="button" class="btn btn-outline-danger">Đổi số điện thoại</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer của card -->
            <div class="card-footer text-center">
                <button type="button" class="btn btn-success btn-md">Lưu thay đổi</button>
            </div>
        </div>
    </div>

    <div id="premium_account" class="container mt-5">
        <div class="card text-white bg-dark shadow-lg">
            <!-- Tiêu đề -->
            <div class="card-header bg-success bg-gradient text-uppercase text-center py-2">
                <h2 class="fw-bold mb-0">Quản lý thuê bao premium</h2>
            </div>

            <!-- Nội dung -->
            <div class="card-body">
                <!-- Form thông tin -->
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label fw-bold">Ngày bắt đầu:</label>
                            <input type="date" id="startDate" class="form-control" value="25/11/2024">
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label fw-bold">Ngày kết thúc:</label>
                            <input type="text" id="endDate" class="form-control" value="25/1/2024">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="accountType" class="form-label fw-bold">Loại thuê bao:</label>
                        <input type="text" id="accountType" class="form-control" value="1 tháng">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Giá gốc:</label>
                        <input type="number" id="price" class="form-control" value="100000">
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div id="footer" class="bg-black mt-2 text-light border-top border-white">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <img src="./assets/image/icon/logo.png" alt="">   
                    </div>
                    <div class="socials-list d-flex justify-content-center mt-1">
                        <a href=""><i class="ti-facebook text-light me-1"></i></a>
                        <a href=""><i class="ti-instagram text-light me-1"></i></a>
                        <a href=""><i class="ti-linux text-light me-1"></i></a>
                        <a href=""><i class="ti-pinterest text-light me-1"></i></a>
                        <a href=""><i class="ti-twitter text-light me-1"></i></a>
                        <a href=""><i class="ti-linkedin text-light"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold fs-3">Liên Hệ</p>
                    <p> <i class="ti-location-pin"></i> Số 123, Đường ABS, Thành phố XYZ</p>
                    <p> <i class="ti-mobile"></i> Phone: <a href="tel:+00151515">0123456789</a></p>
                    <p> <i class="ti-email"></i> Email: <a href="mailto:quangminh4141@gmail.com">Spoticon@mail.com</a></p>
                </div>
                <div class="col-md-4">
                    <p class="fw-bold fs-3">Hỗ Trợ</p>
                    <p>Điều khoản và Dịch vụ</p>
                    <p>Chính sách</p>
                    <p>Về chúng tôi</p>
                </div>    
            </div>
        </div>
    </div>

    
</body>
</html>