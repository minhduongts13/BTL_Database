<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
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
        <div class="card bg-dark text-white shadow-lg">
            <!-- Tiêu đề bài hát -->
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">BÀI HÁT</h2>
            </div>

            <!-- Nội dung bài hát -->
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <!-- Hình ảnh -->
                    <div class="col-md-6 text-center">
                        <img src="./assets/image/slider/song.jpg" class="img-fluid rounded shadow-sm" alt="Image">
                    </div>

                    <!-- Thông tin bài hát -->
                    <div class="col-md-6">
                        <h2 class="card-title fw-bold">AUGUST</h2>
                        <ul class="list-unstyled mt-3">
                            <li><strong>Tác Giả:</strong> Taylor Swift</li>
                            <li><strong>Thời Lượng:</strong> 4:21</li>
                            <li><strong>Ngày Phát Hành:</strong> 24/07/2020</li>
                            <li><strong>Thể Loại:</strong> Pop</li>
                            <li><strong>Credit:</strong> Taylor Swift, Jack Antonoff</li>
                            <li><strong>Đặc Tả:</strong> Đây là bài hát thứ tám trong album phòng thu thứ tám của cô ấy Folklore.</li>
                            <li><strong>Lượt Nghe:</strong> 1,310,468,111</li>
                        </ul>
                    </div>
                </div>

                <!-- Lời bài hát -->
                <div class="mt-4">
                    <h4 class="fw-bold text-uppercase border-bottom pb-2">Lời Bài Hát</h4>
                    <div class="overflow-auto p-3 bg-secondary rounded text-light" style="max-height: 300px;">
                        <p>
                        Salt air, and the rust on your door <br>
                                    I never needed anything more <br>
                                    Whispers of "Are you sure?" <br>
                                    "Never have I ever before" <br> <br>
                                    But I can see us lost in the memory <br>
                                    August slipped away into a moment in time <br>
                                    'Cause it was never mine <br>
                                    And I can see us twisted in bedsheets <br>
                                    August sipped away like a bottle of wine <br>
                                    'Cause you were never mine <br> <br>
                                    Your back beneath the sun <br>
                                    Wishin' I could write my name on it <br>
                                    Will you call when you're back at school? <br>
                                    I remember thinkin' I had you <br> <br>
                                    But I can see us lost in the memory <br>
                                    August slipped away into a moment in time <br>
                                    'Cause it was never mine <br>
                                    And I can see us twisted in bedsheets <br>
                                    August sipped away like a bottle of wine <br>
                                    'Cause you were never mine <br> <br>
                                    Back when we were still changin' for the better <br>
                                    Wanting was enough <br>
                                    For me, it was enough <br>
                                    To live for the hope of it all <br>
                                    Cancel plans just in case you'd call <br>
                                    And say you meet me behind the mall <br>
                                    So much for summer love and saying, "Us" <br>
                                    'Cause you weren't mine to lose <br>
                                    You weren't mine to lose, no <br> <br>
                                    But I can see us lost in the memory <br>
                                    August slipped away into a moment in time <br>
                                    'Cause it was never mine <br>
                                    And I can see us twisted in bedsheets <br>
                                    August sipped away like a bottle of wine <br>
                                    'Cause you were never mine <br>
                                    'Cause you were never mine, never mine <br> <br>
                                    But do you remember? <br>
                                    Remember when I pulled up, and said, "Get in the car" <br>
                                    And then canceled my plans, just in case you'd call <br>
                                    Back when I was livin' for the hope of it all, for the hope of it all <br>
                                    "Meet me behind the mall" <br>
                                    Remember when I pulled up, and said, "Get in the car" <br>
                                    And then canceled my plans, just in case you'd call <br>
                                    Back when I was livin' for the hope of it all, for the hope of it all <br>
                                    "Meet me behind the mall" <br> <br>
                                    Remember when I pulled up, and said, "Get in the car" <br>
                                    And then canceled my plans, just in case you'd call <br>
                                    Back when I was livin' for the hope of it all (for the hope of it all) <br> <br>
                                    For the hope of it all <br>
                                    For the hope of it all <br>
                                    For the hope of it all <br>
                                    For the hope of it all</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
        <div class="container mt-4">
            <div class="card bg-dark text-white shadow-lg">
                <!-- Tiêu đề -->
                <div class="bg-success bg-gradient p-2">
                    <h2 class="card-title mb-0 text-center">ĐÁNH GIÁ</h2>
                </div>
                
                <!-- Nội dung đánh giá -->
                <div class="card-body">
                    <!-- Form đánh giá -->
                    <form class="mb-4">
                        <div class="row g-3">
                            <!-- Điểm đánh giá -->
                            <div class="col-md-4">
                                <label for="rating" class="form-label">Điểm đánh giá</label>
                                <input type="number" class="form-control" id="rating" placeholder="5.0" min="1" max="5" step="0.1">
                                <small class="text-muted">Điểm đánh giá từ 1 đến 5</small>
                            </div>
                            
                            <!-- Nội dung bình luận -->
                            <div class="col-md-8">
                                <label for="comment" class="form-label">Bình luận</label>
                                <textarea class="form-control" id="comment" rows="2" placeholder="Viết bình luận của bạn..."></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                        </div>
                    </form>
                    
                    <!-- Hiển thị đánh giá -->
                    <h4 class="mt-4">Đánh Giá Từ Người Dùng</h4>
                    <div class="border-top pt-3">
                        <!-- Mỗi bình luận -->
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User Avatar">
                            </div>
                            <div>
                                <h5 class="mb-1">Nguyễn Văn A <span class="text-warning">★ 4.5</span></h5>
                                <p class="mb-0">Bài hát xuất sắc, tuyệt vời, đỉnh nóc kịch trần!</p>
                                <small class="text-muted">2 ngày trước</small>
                            </div>
                        </div>
                        
                        <!-- Bình luận khác -->
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User Avatar">
                            </div>
                            <div>
                                <h5 class="mb-1">Trần Thị B <span class="text-warning">★ 5.0</span></h5>
                                <p class="mb-0">Tuyệt vời! Không thể ngừng nghe bài này!</p>
                                <small class="text-muted">3 ngày trước</small>
                            </div>
                        </div>
                        
                        <!-- Thêm nút xem thêm -->
                        <div class="text-center">
                            <button class="btn btn-outline-success btn-sm">Xem thêm đánh giá</button>
                        </div>
                    </div>
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