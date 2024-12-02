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
    <title>Advertisers</title>
</head>

<script>
    function toggle() {
        const filterButton =document.querySelector("#filter_button");
        if (filterButton.innerHTML === "Chỉ xem các hợp đồng có hiệu lực") {
            filterButton.innerHTML = "Xem tất cả các hợp đồng";
        } else {
            filterButton.innerHTML = "Chỉ xem các hợp đồng có hiệu lực";
        }
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
                <h2 class="card-title text-center text-uppercase mb-0">HỢP ĐỒNG QUẢNG CÁO</h2>
            </div>

            <div>
                <?php
                    $idContract = $_GET['idCon'];

                    include "connect.php";
                    $statement = $db->prepare("CALL selectAdvertisement($idContract)");
                   
                    $statement->execute();
                    $result = $statement->fetch();

                    $nameAdvertiser = $result['Ten_don_vi_quang_cao'];
                    $description = $result['Mo_ta'];
                    $dateStart = date_format(date_create($result['Ngay_bat_dau']), 'd-M-Y');
                    $dateEnd = date_format(date_create($result['Ngay_ket_thuc']), 'd-M-Y');

                    echo "
                    <div class='container'>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Nhà quảng cáo:</div>
                            <div class='col'>$nameAdvertiser</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Mô tả quảng cáo:</div>
                            <div class='col'>$description</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Ngày bắt đầu:</div>
                            <div class='col'>$dateStart</div>
                        </div>
                        <div class='row mt-3'>
                            <div class='col text-uppercase'>Ngày kết thúc:</div>
                            <div class='col'>$dateEnd</div>
                        </div>
                    </div>
                    ";

                    $statement = $db->prepare("SELECT getAdsType($idContract)");
                    $statement->execute();
                    $result = $statement->fetch();
                    echo "
                        <div class='container'>
                            <div class='row mt-3'>
                                <div class='col text-uppercase'>Loại:</div>
                                <div class='col'>$result[0]</div>
                            </div>";
                    if ($result[0] == 'Premium') {
                        echo "
                            <div class='mt-5 d-flex justify-content-center fs-4'>
                                DANH SÁCH NGHỆ SĨ ĐƯỢC CHỌN
                            </div>

                            <table class='table table-bordered table-hover table-responsive-lg mt-3'>
                            <thead class='table-success'>
                                <tr>
                                    <th scope='col' class='center width10'>STT</th>
                                    <th scope='col' class='center width50'>NGHỆ DANH NGHỆ SĨ</th>
                                    <th scope='col' class='center width20'>NGÀY BẮT ĐẦU</th>
                                    <th scope='col' class='center width20'>NGÀY HẾT HẠN</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        $statement = $db->prepare("CALL getArtistsForAdsType1($idContract)");
                        $statement->execute();
                        $res = $statement->fetchAll();

                        for ($i = 0; $i < count($res); $i++) {
                            $name = $res[$i]['Nghe_danh'];
                            $startDate = $res[$i]['Ngay_bat_dau'];
                            $endDate = $res[$i]['Ngay_ket_thuc'];
                            echo "
                                <tr>
                                    <th scope='row' class='center width10'>$i</th>
                                    <th scope='col' class='center width50'>$name</th>
                                    <th scope='col' class='center width20'>$startDate</th>
                                    <th scope='col' class='center width20'>$endDate</th>
                                </tr>
                            ";
                        }
                        echo "
                            </tbody>
                        </table>

                        <div class='mt-5 d-flex justify-content-center fs-4'>
                            <a href='add_hot_artist.php?idAd=$idContract'>
                            <button class='btn btn-success'>Thêm nghệ sĩ</button>
                            </a>
                        </div>
                        ";
                    } 
                    // else {
                    //     echo "
                    //         <div class='mt-5 d-flex justify-content-center fs-4'>
                    //             DANH SÁCH BÀI HÁT ĐƯỢC CHỌN
                    //         </div>
                    //     </div>
                    //     <table class='table table-bordered table-hover table-responsive-lg mt-3'>
                    //         <thead class='table-success'>
                    //             <tr>
                    //                 <th scope='col' class='center width10'>STT</th>
                    //                 <th scope='col' class='center width50'>BÀI HÁT</th>
                    //                 <th scope='col' class='center width20'>NGÀY BẮT ĐẦU</th>
                    //                 <th scope='col' class='center width20'>NGÀY HẾT HẠN</th>
                    //             </tr>
                    //         </thead>
                    //         <tbody>
                    //     ";
                    //     $statement = $db->prepare("CALL getSongsForAdsType2($idContract)");
                    //     $statement->execute();
                    //     $res = $statement->fetchAll();
                    //     for ($i = 0; $i < count($res); $i++) {
                    //         $name = $res[$i]['Ten_bai_hat'];
                    //         $startDate = $res[$i]['Ngay_bat_dau'];
                    //         $endDate = $res[$i]['Ngay_ket_thuc'];
                    //         echo "
                    //             <tr>
                    //                 <th scope='row' class='center width10'>$i</th>
                    //                 <th scope='col' class='center width50'>$name</th>
                    //                 <th scope='col' class='center width20'>$startDate</th>
                    //                 <th scope='col' class='center width20'>$endDate</th>
                    //             </tr>
                    //         ";
                    //     }
                    //     echo "
                    //         </tbody>
                    //     </table>

                    //     <div class='mt-5 d-flex justify-content-center fs-4'>
                    //         <button class='btn btn-success'>Thêm bài hát mới</button>
                    //     </div>
                    //     ";
                    // }
                ?>
            </div>
        </div>
    </div>
</body>
</html>