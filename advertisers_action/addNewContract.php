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
    <link rel="icon" type="image/x-icon" href="/assets/image/icon/album1989tv.jpg">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Advertisers</title>
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
                placeholder="Tìm kiếm bài hát, nghệ sĩ..." 
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

    <div class="card bg-dark text-white shadow-lg d-flex container" style="margin-top: 150px">
        
        <?php
            include '../connect.php';

            $addNewAdvertiser = true;
            $id = null;
            if (isset($_POST['index']) && !empty($_POST['index'])) {
                $id = $_POST['index'];
                $statement = $db->prepare("SELECT ID FROM NHA_QUANG_CAO WHERE ID=$id");
                $statement->execute();
                $result = $statement->fetch();
                if (count($result) > 0) {
                    $addNewAdvertiser = false;
                }
            }
            $name = $_POST['ads_name'];
            $des = $_POST['description'];
            
            $start = strtotime($_POST['start_date']);
            $start = date('Y-m-d', $start);
            
            $end = strtotime($_POST['end_date']);
            $end = date('Y-m-d', $end);

            if ($addNewAdvertiser) {
                $statement = null;
                if (empty($_POST['index'])) {
                    $statement = $db->prepare("INSERT INTO NHA_QUANG_CAO (Ten_don_vi_quang_cao, Mo_ta) VALUES ('$name', '$des')");
                    $statement->execute();
                    $statement = $db->prepare("SELECT ID FROM NHA_QUANG_CAO WHERE Ten_don_vi_quang_cao = '$name' AND Mo_ta = '$des'");
                    $statement->execute();
                    $result = $statement->fetch();
                    $id = $result['ID'];
                }
                else {
                    $statement = $db->prepare("INSERT INTO NHA_QUANG_CAO VALUES ($id, $name, $des)");
                    $statement->execute();
                }
            }
            $statement = $db->prepare("INSERT INTO HOP_DONG_QUANG_CAO (Ngay_bat_dau_quang_cao, Thoi_gian_hieu_luc_hop_dong, ID_nha_quang_cao) 
            VALUES ('$start', '$end', $id)");
            $statement->execute();

            $statement = $db->prepare("SELECT ID FROM HOP_DONG_QUANG_CAO 
            WHERE Ngay_bat_dau_quang_cao='$start' AND Thoi_gian_hieu_luc_hop_dong = '$end' AND ID_nha_quang_cao=$id");
            $statement->execute();
            $result = $statement->fetch();
            $idHopDong = $result['ID'];

            $typeOfAd = $_POST['type'];
            if ($typeOfAd == "L1") {
                $statement = $db->prepare("INSERT INTO QUANG_CAO_LOAI_1 VALUES ($idHopDong)");
            } else {
                $statement = $db->prepare("INSERT INTO QUANG_CAO_LOAI_2 VALUES ($idHopDong)");
            }
            $statement->execute();
        ?>
        <p>Thêm hợp đồng thành công</p>
        <a href="advertisers.php">
            <button class="btn btn-light">Quay lại</button>
        </a>

    </div>
</body>
</html>