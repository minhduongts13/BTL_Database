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
                <div class="mt-3 d-flex justify-content-center">
                    <a href="advertisement_add.php">
                    <button class="btn btn-success">Thêm hợp đồng</button>
                    </a>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    <a href="advertiser_list.php">
                    <button class="btn btn-secondary">Xem các nhà quảng cáo</button>
                    </a>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <form method="post" action="" id="filter_value">
                        <input class="form-check-input" type="radio" id="filter" name="is_filter" value="true">
                        <label for="is_filter">Chỉ xem những hợp đồng có hiệu lực</label> <br>
                        <input class="form-check-input" type="radio" id="not_filter" name="is_filter" value="false">
                        <label for="not_filter">Xem tất cả</label> <br>
                        <input class="btn btn-primary mt-3" type="submit">
                    </form>
                </div>

            </div>

            <table class="table table-bordered table-hover table-responsive-lg mt-3">
                <thead class="table-success">
                    <tr>
                        <th scope="col" class="center width10">STT</th>
                        <th scope="col" class="center width30">NHÀ QUẢNG CÁO</th>
                        <th scope="col" class="center width20">NGÀY BẮT ĐẦU</th>
                        <th scope="col" class="center width20">NGÀY HẾT HẠN</th>
                        <th scope="col" class="center width20">CHI TIẾT</th>
                    </tr>
                </thead>

                <tbody class="table-dark">

                    <?php
                        include "connect.php";
                        $is_filter = false;
                        if (isset($_POST['is_filter']) && $_POST['is_filter'] == 'true') {
                            $is_filter = true;
                        }

                        $now = new DateTime();
                        
                        if ($is_filter) {
                            $statement = $db->prepare("CALL getAllAdvertisementsInEffect();");
                        } else {
                            $statement = $db->prepare("CALL getAllAdvertisements();");
                        }
                        $statement->execute();
                        $result = $statement->fetchAll();
                        
                        $count = 1;
                        for ($i = 0; $i < count($result); $i++) {
                            $idCon = $result[$i]['ID'];
                            $name = $result[$i]['Ten_don_vi_quang_cao'];
                            $dateStart = date_create($result[$i]['Ngay_bat_dau']);
                            $dateEnd = date_create($result[$i]['Ngay_ket_thuc']);

                            if (($dateStart > $now || $dateEnd < $now) && ($is_filter)) {
                                continue;
                            }

                            $dateStart = date_format($dateStart, 'd-m-Y');
                            $dateEnd = date_format($dateEnd, 'd-m-Y');
                            echo "
                                <tr>
                                    <th scope='row' class='center width10'>$count</th>
                                    <td class='width30'>$name</td>
                                    <td class='center width20'>$dateStart</td>
                                    <td class='center width20'>$dateEnd</td>
                                    <td class='center width20'>
                                        <a href='advertisment.php?idCon=$idCon'>
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            ";
                            $count++;
                        }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</body>
</html>