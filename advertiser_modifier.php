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
    <title>Advertisers</title>
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

    <div id='song-description' class='container'>
        <div class='card bg-dark text-white shadow-lg'>
            <div class='bg-success bg-gradient p-2'>
                <h2 class='card-title text-center text-uppercase mb-0'>SỬA NHÀ QUẢNG CÁO</h2>
            </div>

            <?php 
            include 'connect.php';
            $idAds = $_GET['idAds'];
            $statement = $db->prepare("SELECT * FROM NHA_QUANG_CAO WHERE ID=$idAds");
            $statement->execute();
            $result = $statement->fetch();

            $name = $result['Ten_don_vi_quang_cao'];
            $des = $result['Mo_ta'];

            echo "
            <form method='post' action='advertisers_action\modifyAdvertiser.php?idCom=$idAds' id='addNewContract'>

                <div class='form-group row mt-2'>
                    <label for='name-advertiser' class='col-sm-2 col-form-label'>Tên nhà quảng cáo</label>
                    <div class='col-sm-4'>
                        <input type='text' class='form-control' id='name-advertiser' placeholder='Nhập tên nhà quảng cáo' name='advertiser_name' value='$name' required>
                    </div>
                </div>

                <div class='form-group row mt-2'>
                    <label for='description-advertiser' class='col-sm-2 col-form-label'>Mô tả nhà quảng cáo</label>
                    <div class='col-sm-6'>
                        <textarea class='form-control' id='description-advertiser' placeholder='Nhập mô tả nhà quảng cáo' name='description' rows='5'>$des</textarea>
                    </div>
                </div>                

                <div class='form-group row mt-2 d-flex justify-content-center'>
                    <input class='btn btn-primary col-sm-1' type='submit'>
                </div>
            </form>
            ";
            ?>

            <div class="mt-3 d-flex justify-content-center">
                <a href="advertiser_list.php">
                <button class="btn btn-light">Quay lại</button>
                </a>
            </div>
    </div>
</body>
</html>