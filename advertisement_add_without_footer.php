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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Thêm hợp đồng quảng cáo</title>
    <?php include("auth.php") ?>
</head>

<script>
    function findAdvertiser(id) {
        if (id == "") {
            $("#name-advertiser").prop('readonly', false);
            $("#description-advertiser").prop('readonly', false);
            $("#name-advertiser").val('');
            $("#description-advertiser").val('');
        } else 
        $.ajax({
            type: "GET",
            url: "advertisers_action\\findAds.php",
            data: "idAd="+id,
            success: function(result) {
                console.log(result);
                if (result != "empty") {
                    const response = JSON.parse(result);
                    $("#name-advertiser").val(response.name);
                    $("#name-advertiser").prop('readonly', true);
                    $("#description-advertiser").val(response.des);
                    $("#description-advertiser").prop('readonly', true);
                } else {
                    $("#name-advertiser").val("");
                    $("#description-advertiser").val("");
                }
            }
        })
    }

</script>

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

    <div id="song-description" class="container min-vh-100">
        <div class="card bg-dark text-white shadow-lg">
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">THÊM HỢP ĐỒNG QUẢNG CÁO</h2>
            </div>

            <form method="post" action="advertisement_add.php" id="addNewContract">
                <div class="form-group row mt-2">
                    <label for="name-advertiser" class="col-sm-2 col-form-label">Tên nhà quảng cáo</label>
                    <div class="col-sm-8 col-md-6">
                        <input type="text" class="form-control" id="name-advertiser" placeholder="Nhập tên nhà quảng cáo" name="ads_name" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <label for="date-start" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                    <div class="col-sm-8 col-md-6">
                        <input type="date" class="form-control" id="name-advertiser" name="start_date" placeholder="Nhập ngày bắt đầu" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <label for="date-end" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                    <div class="col-sm-8 col-md-6">
                        <input type="date" class="form-control" id="name-advertiser" name="end_date" placeholder="Nhập ngày kết thúc" required>
                    </div>
                </div>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" id="L1" name="type" value="L1" required>
                    <label for="L1">Loại premium</label> <br>
                    <input class="form-check-input" type="radio" id="L2" name="type" value="L2" required>
                    <label for="L2">Loại thường</label> <br>
                </div>

                <div class="form-group row mt-2 d-flex justify-content-center">
                    <button class="btn btn-primary col-sm-2 col-md-1" type="submit">Thêm</button>
                </div>
            </form>

            <div class="mt-3 d-flex justify-content-center">
                <a href="advertisement_list.php">
                <button class="btn btn-light">Quay lại</button>
                </a>
            </div>

            <?php
                include 'connect.php';

                if (isset($_POST['ads_name'])) {
                    $advertiser = $_POST['ads_name'];
                    
                    $start = strtotime($_POST['start_date']);
                    $start = date('Y-m-d', $start);
                    
                    $end = strtotime($_POST['end_date']);
                    $end = date('Y-m-d', $end);

                    $type = $_POST['type'];
                    $statement = $db->prepare("SELECT addAdvertisement('$advertiser', '$start', '$end', '$type')");
                    $statement->execute();
                    $result = $statement->fetch();
                    echo "
                        <div class='d-flex justify-content-center mt-3'>$result[0]</div>
                    ";
                } else {
                    echo "<div></div>";
                }
            ?>
    </div>

</body>
</html>