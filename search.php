<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Main Page</title>
    <?php include("auth.php") ?>
</head>
<body class="bg-black text-light">
    <!-- Header -->
    <div class="header container-fluid border-bottom-0 d-flex align-items-center bg-black fixed-top py-3 px-4 shadow-lg">
        <a href="homePage.php" class="text-decoration-none">
            <h1 class="header__title me-4 fw-bold text-uppercase text-light">Spoticon</h1>
        </a>
        <form class="d-flex flex-grow-1" role="search" method="GET" action="search.php">
            <input id="Search" class="form-control me-2 rounded-pill border-0 shadow-sm" type="text" name="query" placeholder="Tìm kiếm bài hát, nghệ sĩ..." aria-label="Search" style="max-width: 600px; background-color: #1e1e1e; color: #fff;">
            <button class="btn btn-success rounded-pill px-4" type="submit">Tìm kiếm</button>
        </form>

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

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <!-- Danh sách bài hát -->
        <section id="song-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách kết quả tìm kiếm bài hát</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                $query = $_GET['query'];
                // Query to get songs
                $stmt = $db->prepare("CALL `assignment2`.`SearchSongsByName`(:query);
");
                $stmt->execute(['query' => $query]);
                $songs = $stmt->fetchAll();

                // Loop through songs and create cards
                foreach ($songs as $song) {
                    echo '<div class="col-md-3 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">' . htmlspecialchars($song['Ten_Bai_Hat']) . '</h5>
                                    <p class="card-text"><small>Ngày phát hành: ' . htmlspecialchars($song['Ngay_Phat_Hanh']) . '</small></p>
                                    <a href="http://localhost/song_page.php?id=' . htmlspecialchars($song['ID_Bai_Hat']) . '" class="btn btn-success btn-sm">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách nghệ sĩ -->
        <section id="artist-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách kết quả tìm kiếm nghệ sĩ</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                $query = $_GET['query'];
                $stmt = $db->prepare("CALL SearchArtistsByName(:query)");
                $stmt->execute(['query' => $query]);
                $artists = $stmt->fetchAll();
                foreach ($artists as $artist) {
                    echo '<div class="col-md-4 mb-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body text-center">
                                    <a class="text-decoration-none text-white" href=artist_page.php?id='. $artist['ID_Nghe_Si'] .'
                                        <h5 class="card-title">' . htmlspecialchars($artist['Nghe_Danh']) . '</h5>
                                    </a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách nhà phát hành -->
        <section id="publisher-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Kết quả tìm kiếm album</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                $query = $_GET['query'];
                $stmt = $db->prepare("CALL SearchAlbumsByName(:query);");
                $stmt->execute(['query' => $query]);
                $albums = $stmt->fetchAll();
                foreach ($albums as $album) {
                    echo '
                    <div class="col-md-6 mb-3">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                <a class="text-decoration-none text-white" href=albuminfor.php?id='. $album['ID_Album'] .'
                                    <h5 class="card-title">' . htmlspecialchars($album['Ten_Album']) . '</h5>
                                    <p class="card-text"><small>Ngày phát hành: ' . htmlspecialchars($album['Ngay_Phat_Hanh']) . '</small></p>
                                </a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
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
</body>
</html>
