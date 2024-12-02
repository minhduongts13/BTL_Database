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
            <div class="bg-success bg-gradient p-2">
                <h2 class="card-title text-center text-uppercase mb-0">THÊM NGHỆ SĨ</h2>
            </div>

            <?php 
                include 'connect.php';
                $idAd = $_GET['idAd'];
                $statement = $db->prepare("CALL getAllHotArtists");
                $statement->execute();
                $result = $statement->fetchAll();
                $listOfOption = [];
                for ($i = 0; $i < count($result); $i++) {
                    $listOfOption[] = $result[$i]['Nghe_danh'];
                }
                echo "
                <form method='post' id='addNewContract' action='advertisers_action/addNewArtist.php?idAd=$idAd'>
                    <div class='form-group row mt-2'>
                        <label for='name-advertiser' class='col-sm-2 col-form-label'>Chọn nghệ sĩ</label>
                        <div class='col-sm-4'>
                        <select name='artist' id='artists' class='form-select'>
                ";
                for ($i = 0; $i < count($result); $i++) {
                    echo "<option value='" . $listOfOption[$i] . "'>" . $listOfOption[$i] .  "</option>";
                }

                echo "
                        </select>
                    </div>
                </div>

                <div class='mt-3 d-flex justify-content-center'>
                    <input type='submit' class='btn btn-primary'>
                </div> 
            </form>"
            ?>

            <div class="mt-3 d-flex justify-content-center">
                <a href="advertisement_list.php">
                <button class="btn btn-light">Quay lại</button>
                </a>
            </div>
    </div>
</body>
</html>