<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/song_page.css">
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <title>Spoticon</title>
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
            <h2 class="text-uppercase fw-bold mb-4">Danh sách bài hát</h2>
            <div class="row">
                <?php
                include 'connect.php'; // Connect to the database
                
                // Query to get songs
                $stmt = $db->prepare("SELECT ID, Ten_bai_hat, Ngay_phat_hanh FROM BAI_HAT LIMIT 8;");
                $stmt->execute();
                $songs = $stmt->fetchAll();
                $img = array('https://media.pitchfork.com/photos/6614092742a7de97785c7a48/master/w_1280%2Cc_limit/Billie-Eilish-Hit-Me-Hard-and-Soft.jpg', 'https://miro.medium.com/max/6000/1*O6soMKjf8PPr9lb6ong_Fw.jpeg', 'https://i.scdn.co/image/ab67616d0000b27371dea61e1ce07e18c746d775', 'https://th.bing.com/th/id/OIP.ihrb6OsCLaaNNeUX9zfp0wHaHa?rs=1&pid=ImgDetMain', 'https://images.genius.com/bcaf43cefdd93a9be1da5d17d4a061f9.1000x1000x1.jpg', 'https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/61/3d/86/613d86b4-e539-108e-84f7-46ce1962f778/190296036132.jpg/1200x1200bf-60.jpg', 'https://th.bing.com/th/id/OIP.UgvF6caKdQipEANwQGcC4wHaHa?rs=1&pid=ImgDetMain', 'https://e.snmc.io/i/600/s/b8168764a6812ba7ee521cd32406b9ad/12621308/rose-and-bruno-mars-apt-cover-art.jpg', 'https://th.bing.com/th/id/OIP.64Ec-8p__cNSfhVuhf14rwHaHa?rs=1&pid=ImgDetMain', 'https://upload.wikimedia.org/wikipedia/en/3/38/When_We_All_Fall_Asleep%2C_Where_Do_We_Go%3F.png', 'https://th.bing.com/th/id/OIP.wljmAULxSw3-tgVzTPp_SAHaHa?rs=1&pid=ImgDetMain');
                // Loop through songs and create cards
                foreach ($songs as $song) {
                    $img_i = rand(0, count($img) - 1);
                    echo '<div class="col-md-3 mb-4">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                    <h5 class="card-title text-truncate">' . htmlspecialchars($song['Ten_bai_hat']) . '</h5>
                                    <p class="card-text"><small>Ngày phát hành: ' . htmlspecialchars($song['Ngay_phat_hanh']) . '</small></p>
                                    <a href="song_page.php?id=' . htmlspecialchars($song['ID']) . '" class="btn btn-success btn-sm">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách thể loại -->
        <section id="genre-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách thể loại</h2>
            <div class="row">
                <?php
                $stmt = $db->prepare("SELECT DISTINCT The_loai FROM THE_LOAI_BAI_HAT LIMIT 6;");
                $stmt->execute();
                $genres = $stmt->fetchAll();
                $img = array('https://media.pitchfork.com/photos/6614092742a7de97785c7a48/master/w_1280%2Cc_limit/Billie-Eilish-Hit-Me-Hard-and-Soft.jpg', 'https://miro.medium.com/max/6000/1*O6soMKjf8PPr9lb6ong_Fw.jpeg', 'https://i.scdn.co/image/ab67616d0000b27371dea61e1ce07e18c746d775', 'https://th.bing.com/th/id/OIP.ihrb6OsCLaaNNeUX9zfp0wHaHa?rs=1&pid=ImgDetMain', 'https://images.genius.com/bcaf43cefdd93a9be1da5d17d4a061f9.1000x1000x1.jpg', 'https://is5-ssl.mzstatic.com/image/thumb/Music122/v4/61/3d/86/613d86b4-e539-108e-84f7-46ce1962f778/190296036132.jpg/1200x1200bf-60.jpg', 'https://th.bing.com/th/id/OIP.UgvF6caKdQipEANwQGcC4wHaHa?rs=1&pid=ImgDetMain', 'https://e.snmc.io/i/600/s/b8168764a6812ba7ee521cd32406b9ad/12621308/rose-and-bruno-mars-apt-cover-art.jpg', 'https://th.bing.com/th/id/OIP.64Ec-8p__cNSfhVuhf14rwHaHa?rs=1&pid=ImgDetMain', 'https://upload.wikimedia.org/wikipedia/en/3/38/When_We_All_Fall_Asleep%2C_Where_Do_We_Go%3F.png', 'https://th.bing.com/th/id/OIP.wljmAULxSw3-tgVzTPp_SAHaHa?rs=1&pid=ImgDetMain');
                foreach ($genres as $genre) {
                    $img_i = rand(0, count($img) - 1);
                    echo '<div class="col-md-3 mb-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body text-center">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                    <h5 class="card-title">' . htmlspecialchars($genre['The_loai']) . '</h5>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>

        <!-- Danh sách nghệ sĩ -->
        <section id="artist-list" class="mb-5">
            <h2 class="text-uppercase fw-bold mb-4">Danh sách nghệ sĩ</h2>
            <div class="row">
                <?php
                $stmt = $db->prepare("SELECT DISTINCT ID, Nghe_danh FROM NGHE_SI LIMIT 6;");
                $stmt->execute();
                $artists = $stmt->fetchAll();
                $img = array('https://yt3.googleusercontent.com/oN0p3-PD3HUzn2KbMm4fVhvRrKtJhodGlwocI184BBSpybcQIphSeh3Z0i7WBgTq7e12yKxb=s900-c-k-c0x00ffffff-no-rj', 'https://th.bing.com/th/id/OIP.byu4wb3Ag5IKYqZcJT_eXwHaHa?w=683&h=683&rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.6007a8c23db45c36488bfa7a0035d090?rik=y7ZfdfdUUiPaaw&pid=ImgRaw&r=0', 'https://cdnphoto.dantri.com.vn/ecdPkKw4WCg-NR0Zi2shwRYyUlo=/thumb_w/1020/2022/11/10/micheal-jackson-1668044313441.jpg', 'https://media.vov.vn/sites/default/files/styles/large/public/2021-08/image_7.jpeg.jpg', 'https://yt3.googleusercontent.com/gam065jhT3tmDHVFglA846lO0oNHImdty7Vw2ATuWOzcamMWmsNYzVqrmtlWX1egn6BKYq__Mw=s900-c-k-c0x00ffffff-no-rj');
                foreach ($artists as $artist) {
                    $img_i = rand(0, count($img) - 1);
                    echo '<div class="col-md-3 mb-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body text-center">
                                
                                <a class="text-decoration-none text-white" href="artist_page.php?id='. $artist['ID'] .'">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                        <h5 class="card-title">' . htmlspecialchars($artist['Nghe_danh']) . '</h5>
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
            <h2 class="text-uppercase fw-bold mb-4">Danh sách nhà phát hành</h2>
            <div class="row">
                <?php
                $stmt = $db->prepare("SELECT ID, Ten_nha_phat_hanh, Ngay_thanh_lap FROM NHA_PHAT_HANH LIMIT 4;");
                $stmt->execute();
                $publishers = $stmt->fetchAll();
                $img = array('https://i.pinimg.com/736x/73/8a/d9/738ad91d16aa4da249b591754266f502.jpg', 'https://th.bing.com/th/id/OIP.r7hL4dlMeXp-dZM13D8WZgHaHa?rs=1&pid=ImgDetMain', 'https://th.bing.com/th/id/R.6db48a89b2413ce211c4676407fdf039?rik=PfL1Hc4E9kIoFg&pid=ImgRaw&r=0');
                foreach ($publishers as $publisher) {
                    $img_i = rand(0, count($img) - 1);
                    echo '
                    <div class="col-md-3 mb-3">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                <a class="text-decoration-none text-white" href="publisher_page.php?id='. $publisher['ID'] .'">
                                    <img class="img-fluid mb-2" src="'.$img[$img_i].'" alt="song image">
                                    <h5 class="card-title">' . htmlspecialchars($publisher['Ten_nha_phat_hanh']) . '</h5>
                                    <p class="card-text"><small>Ngày thành lập: ' . htmlspecialchars($publisher['Ngay_thanh_lap']) . '</small></p>
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
