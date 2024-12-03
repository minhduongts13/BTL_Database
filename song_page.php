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
    <?php include("auth.php") ?>
    <title>Spoticon</title>
</head>
<body class="bg-black">
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>

        <!-- Thanh tìm kiếm -->
        <form class="d-flex flex-grow-1" role="search" method="GET" action="search.php">
            <input id="Search" class="form-control me-2 rounded-pill border-0 shadow-sm" type="text" name="query" placeholder="Tìm kiếm bài hát, nghệ sĩ..." aria-label="Search" style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
            <button class="btn btn-success rounded-pill px-4" type="submit">Tìm kiếm</button>
        </form>

        <!-- Các nút chức năng -->
        <div class="ms-4 d-flex gap-3">
            <a href="advertiser_list.php" class="text-decoration-none text_light">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Nhà quảng cáo</button>
            </a>
            <a href="advertisement_list.php" class="text-decoration-none text_light">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Quảng cáo</button>
            </a>
            <?php 
            echo '
            <a class="text-decoration-none text_light" href="playlist.php?id='. $_SESSION['user_id'] .'">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2">Playlist của tôi</button>
            </a>
            ';
            ?>
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
                        <?php
                            include 'connect.php'; // Kết nối đến CSDL
                            $id = $_GET['id'];
                            $stmt = $db->prepare("SELECT 
                                    BAI_HAT.ID AS Ma_Bai_Hat,
                                    BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat,
                                    BAI_HAT.Thoi_luong AS Thoi_Luong,
                                    BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh,
                                    GROUP_CONCAT(DISTINCT THE_LOAI_BAI_HAT.The_loai SEPARATOR ', ') AS The_Loai,
                                    GROUP_CONCAT(DISTINCT CREDIT_BAI_HAT.Credit SEPARATOR ', ') AS Credit,
                                    BAI_HAT.Mo_ta_bai_hat AS Mo_Ta
                                FROM 
                                    BAI_HAT
                                LEFT JOIN 
                                    THE_LOAI_BAI_HAT ON BAI_HAT.ID = THE_LOAI_BAI_HAT.ID_Bai_hat
                                LEFT JOIN 
                                    CREDIT_BAI_HAT ON BAI_HAT.ID = CREDIT_BAI_HAT.ID_bai_hat
                                WHERE 
                                    BAI_HAT.ID = $id;
                                GROUP BY 
                                    BAI_HAT.ID
                            ");

                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            if (count($result) > 0) {
                                    echo '
                                    <h2 class="card-title fw-bold text-uppercase">' . $result[0]['Ten_Bai_Hat'] . '</h2>
                                    <ul class="list-unstyled mt-3">
                                        <li><strong>Tác Giả:</strong> ' . $result[0]['Credit'] . '</li>
                                        <li><strong>Thời Lượng:</strong> ' . $result[0]['Thoi_Luong'] . '</li>
                                        <li><strong>Ngày Phát Hành:</strong> ' . $result[0]['Ngay_Phat_Hanh'] . '</li>
                                        <li><strong>Thể Loại:</strong> ' . $result[0]['The_Loai'] . '</li>
                                        <li><strong>Credit:</strong> ' . $result[0]['Credit'] . '</li>
                                        <li><strong>Đặc Tả:</strong> ' . $result[0]['Mo_Ta'] . '</li>
                                        <li><strong>Lượt Nghe:</strong> 1,310,468,111 </li>';
            
                            } else {
                                echo "Không có sản phẩm nào";
                            }
                        ?>
                        </ul>
                    </div>
                </div>

                <!-- Lời bài hát -->
                <div class="mt-4">
                    <h4 class="fw-bold text-uppercase border-bottom pb-2">Lời Bài Hát</h4>
                    <div class="overflow-auto p-3 bg-secondary rounded text-light" style="max-height: 300px;">
                    <?php
                            include 'connect.php'; // Kết nối đến CSDL
                            
                            $stmt = $db->prepare("SELECT 
                                    Loi_bai_hat
                                FROM 
                                    BAI_HAT
                            ");

                            $stmt->execute();

                            $result = $stmt->fetchAll();

                            if (count($result) > 0) {
                                    echo '
                                    <p>'. $result[0]['Loi_bai_hat'] .'</p>';
                            } else {
                                echo "Không có sản phẩm nào";
                            }
                        ?>    
                    <!-- <p>
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
                        </p> -->
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
                    <?php
                    echo '
                    <form class="mb-4" method="POST" action="comment.php?id='. $_GET['id'] .'">
                        <div class="row g-3">
                            <!-- Điểm đánh giá -->
                            <div class="col-md-4">
                                <label for="rating" class="form-label">Điểm đánh giá</label>
                                <input type="number" name="rating" class="form-control" id="rating" placeholder="5.0" min="1" max="5" step="0.1">
                                <small class="text-muted">Điểm đánh giá từ 1 đến 5</small>
                            </div>
                            
                            <!-- Nội dung bình luận -->
                            <div class="col-md-8">
                                <label for="comment" class="form-label">Bình luận</label>
                                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Viết bình luận của bạn..."></textarea>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                        </div>
                    </form>';
                    ?>
                    <?php
                        include 'connect.php'; // Kết nối đến CSDL
                        $id = $_GET['id'];
                        $stmt = $db->prepare("SELECT CalculateSongRating(:id) AS AverageRating");
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();

                        // Lấy kết quả từ hàm
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $mark = $result['AverageRating'] ?? 0; // Giá trị trả về
                        echo '
                        <!-- Hiển thị đánh giá -->
                        <h4 class="mt-4">Đánh Giá Từ Người Dùng:<span class="text-warning">★' . $mark . '</span> </h4>
                        <div class="border-top pt-3">
                        '
                    ?>
                        <!-- Mỗi bình luận -->
                        <?php
                            include 'connect.php'; // Kết nối đến CSDL
                                $id = $_GET['id'];
                                $stmt = $db->prepare("SELECT 
                                    NGUOI_DUNG.Ten_dang_nhap AS Ten_Nguoi_Binh_Luan,
                                    NOI_DUNG_BINH_LUAN.Noidung AS Noi_Dung_Binh_Luan,
                                    RATE.Diem AS Diem_Rate
                                FROM 
                                    NOI_DUNG_BINH_LUAN
                                LEFT JOIN 
                                    NGUOI_DUNG ON NOI_DUNG_BINH_LUAN.ID_nguoi_dung = NGUOI_DUNG.ID
                                LEFT JOIN 
                                    RATE ON NOI_DUNG_BINH_LUAN.ID_Bai_hat = RATE.ID_Bai_hat 
                                    AND NOI_DUNG_BINH_LUAN.ID_nguoi_dung = RATE.ID_nguoi_dung
                                WHERE NOI_DUNG_BINH_LUAN.ID_Bai_hat = $id;
                                ");

                                $stmt->execute();

                                $result = $stmt->fetchAll();

                                if (count($result) > 0) {
                                    foreach ($result as $row)
                                        echo 
                                        '<div class="d-flex mb-3">
                                            <div class="me-3">
                                                <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User Avatar">
                                            </div>
                                            <div>
                                                <h5 class="mb-1">' . $row['Ten_Nguoi_Binh_Luan'] . '<span class="text-warning"> ★ ' . $row['Diem_Rate'] . '</span></h5>
                                                <p class="mb-0">' . $row['Noi_Dung_Binh_Luan'] . '</p>
                                                <small class="text-muted">2 ngày trước</small>
                                            </div>
                                        </div>';
                
                                } else {
                                    echo "Không có bình luận nào";
                                }
                            ?>
                        
                        
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
                        <a href="homePage.php">
                            <img src="./assets/image/icon/logo.png" alt="">   
                        </a>
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