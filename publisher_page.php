<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/publisher_page.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Spoticon - The Publisher</title>
    <?php include("auth.php") ?>
</head>
<body class="bg-black">
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <!-- Tiêu đề -->
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>

        <!-- Thanh tìm kiếm -->
        <form class="d-flex flex-grow-1" role="search">
            <input id="Search" 
                class="form-control me-2 rounded-pill border-0 shadow-sm" 
                type="search" 
                placeholder="Tìm kiếm nghệ sĩ, nghệ sĩ..." 
                aria-label="Search" 
                style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
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

    
    <div id="artist-description" class="container">
        <div class="card bg-dark text-white shadow-lg">
            <!-- Tiêu đề nhà phát hành -->
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">NHÀ PHÁT HÀNH</h2>
            </div>

            <!-- Nội dung nhà phát hành -->
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <!-- Hình ảnh -->
                    <div class="col-md-6 text-center">
                        <img src="./assets/image/slider/publisher.jpg" class="img-fluid rounded shadow-sm" alt="Image">
                    </div>

                    <!-- Thông tin nhà phát hành -->
                    <div class="col-md-6">
                        <?php
                            include 'connect.php'; // Kết nối đến CSDL
                            $id = $_GET['id'];
                            $stmt = $db->prepare("SELECT 
                                    NHA_PHAT_HANH.ID AS Ma_Nph,
                                    NHA_PHAT_HANH.Ten_nha_phat_hanh AS Ten_Nph,
                                    NHA_PHAT_HANH.Ngay_thanh_lap AS Ngay_Thanh_Lap
                                FROM 
                                    NHA_PHAT_HANH
                                WHERE 
                                    NHA_PHAT_HANH.ID = $id;
                                GROUP BY 
                                    NHA_PHAT_HANH.ID
                            ");

                            $stmt->execute();

                            $result = $stmt->fetchAll();
                            if (count($result) > 0) {
                                    echo '
                                    <h2 class="card-title fw-bold text-uppercase">' . $result[0]['Ten_Nph'] . '</h2>
                                    <ul class="list-unstyled mt-3">
                                        <li><strong>Ngày thành lập::</strong> ' . $result[0]['Ngay_Thanh_Lap'] . '</li>
                                    </ul>';
                            } else {
                                echo "Không tìm thấy nhà phát hành";
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card bg-dark text-white shadow-lg">
            <div class="card-body">    
                <div class="container mt-4">
                    <!-- Hiển thị nghệ sĩ nổi bật-->
                    <h4 class="mt-4">Các nghệ sĩ nổi bật</h4>
                            <div class="border-top pt-3">
                                <!-- Mỗi nghệ sĩ-->
                                <?php
                                    include 'connect.php'; // Kết nối đến CSDL
                                        $id = $_GET['id'];
                                        //Hiển thị 5 nghệ sĩ có tổng lượt nghe cao nhất từ ID nhà phát hành
                                        $stmt = $db->prepare("CALL GetTop5ArtistByPublisher($id);
                                        ");

                                        $stmt->execute();

                                        $result = $stmt->fetchAll();

                                        if (count($result) > 0) {
                                            for ($i=0;$i<count($result);$i++) {
                                                $result[$i]['Ho_Ten'] = trim($result[$i]['Ho_Nghe_Si']).' '.trim($result[$i]['Ten_Nghe_Si']);
                                                echo 
                                                '<div >
                                                                                                                                                                   
                                                    <div class="row my-3 p-3" id="showSongs">
                                                        <div class="col-auto">
                                                            <img src="https://via.placeholder.com/50" class="rounded-circle" alt="User Avatar">
                                                        </div>   
                                                        <div class="col">
                                                            <h5 class="mb-1">' . $result[$i]['Nghe_Danh'] . '</h5>
                                                            <p class="mb-0"> Họ tên: ' . $result[$i]['Ho_Ten'] . '</p>
                                                            <p class="mb-0"> Tổng lượt nghe: ' . $result[$i]['Tong_Luot_Nghe'] . '</p>
                                                        </div>
                                                        <div class="col text-end align-middle">
                                                            <form action="artist_page.php" method="get" style="display:inline;">
                                                                <input type="hidden" name="id" value="' . $result[$i]['ID_Nghe_Si'] . '">
                                                                <button type="submit" class="btn btn-success">Xem chi tiết</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                        } else {
                                            echo "Nhà phát hành này chưa có nghệ sĩ nào.";
                                        }
                                ?>
                                
                                <!-- Thêm nút xem thêm -->
                                <div class="text-center">
                                    <button class="btn btn-outline-success btn-sm">Xem thêm nghệ sĩ</button>
                                </div>
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