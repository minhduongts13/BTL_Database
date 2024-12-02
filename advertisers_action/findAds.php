<?php
    if (isset($_GET['idAd'])) {
        include '../connect.php';

        $idQuery = $_GET['idAd'];

        $statement = $db->prepare("SELECT Ten_don_vi_quang_cao, Mo_ta FROM NHA_QUANG_CAO ads WHERE ads.ID = $idQuery");
        $statement->execute();
        $result = $statement->fetch();
        
        if (count($result) > 0) {
            $name = $result['Ten_don_vi_quang_cao'];
            $description = $result['Mo_ta'];
            echo json_encode(array("name"=>$name, "des"=>$description));
        } else {
            echo "empty";
        }
    }
?>
