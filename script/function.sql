


DELIMITER $$

CREATE FUNCTION CalculateRemainingDays(userID INT) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    -- Declare variables
    DECLARE userExists INT;
    DECLARE subscriptionEndDate DATE;
    DECLARE remainingDays INT;
    DECLARE resultMessage VARCHAR(255);

    -- Check if userID is valid
    IF userID IS NULL OR userID <= 0 THEN
        RETURN 'ID người dùng không hợp lệ!';
    END IF;

    -- Check if user exists
    SELECT COUNT(*) INTO userExists
    FROM NGUOI_DUNG
    WHERE ID = userID;

    IF userExists = 0 THEN
        RETURN 'ID người dùng không tồn tại!';
    END IF;

    -- Get subscription end date
    SELECT Ngay_ket_thuc INTO subscriptionEndDate FROM THUE_BAO_PREMIUM
WHERE ID_nguoi_dung = userID
  AND Ngay_ket_thuc >= CURDATE()
  AND Ngay_bat_dau <= CURDATE()
LIMIT 1;


    -- Calculate remaining days
    IF subscriptionEndDate IS NULL THEN
        SET resultMessage = CONCAT('Người dùng ID ', userID, ' không có thuê bao Premium.');
    ELSE
        SET remainingDays = DATEDIFF(subscriptionEndDate, CURDATE());

        IF remainingDays < 0 THEN
            SET resultMessage = CONCAT('Thuê bao Premium của người dùng ID ', userID, ' đã hết hạn.');
        ELSE
            SET resultMessage = CONCAT('Còn ', remainingDays, ' ngày sử dụng thuê bao Premium.');
        END IF;
    END IF;

    RETURN resultMessage;
END$$

DELIMITER ;



DELIMITER $$

CREATE FUNCTION CalculateSongRating(songID INT) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    -- Declare variables
    DECLARE songExists INT;
    DECLARE avgRating DECIMAL(3, 2);
    DECLARE totalRatings INT;
    DECLARE resultMessage VARCHAR(255);

    -- Check if songID is valid
    IF songID IS NULL OR songID <= 0 THEN
        RETURN 'ID bài hát không hợp lệ!';
    END IF;

    -- Check if song exists
    SELECT COUNT(*) INTO songExists
    FROM BAI_HAT
    WHERE ID = songID;

    IF songExists = 0 THEN
        RETURN 'ID bài hát không tồn tại trong bảng BAI_HAT!';
    END IF;

    -- Calculate total ratings
    SELECT COUNT(*) INTO totalRatings
    FROM RATE
    WHERE ID_bai_hat = songID;

    -- Calculate average rating
    SELECT AVG(Diem) INTO avgRating
    FROM RATE
    WHERE ID_bai_hat = songID;

    -- Check if there are no ratings
    IF totalRatings = 0 THEN
        SET resultMessage = CONCAT('Bài hát ID chưa có lượt đánh giá nào.');
    ELSE
        SET resultMessage = CONCAT(totalRatings, ' lượt đánh giá. Điểm trung bình: ', ROUND(avgRating, 2));
    END IF;

    RETURN resultMessage;
END$$

DELIMITER ;

DELIMITER $$

CREATE FUNCTION checkLogin(username VARCHAR(255), password VARCHAR(255)) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE userId INT;
    DECLARE storedPassword VARCHAR(255);
    DECLARE result VARCHAR(255);

    -- Lấy ID và mật khẩu từ cơ sở dữ liệu
    SELECT ID, Mat_khau INTO userId, storedPassword 
    FROM NGUOI_DUNG 
    WHERE Ten_dang_nhap = username;

    -- Kiểm tra trạng thái đăng nhập
    IF userId IS NULL THEN
        SET result = 'Tài khoản không tồn tại:0'; -- 0 đại diện cho ID không hợp lệ
    ELSEIF storedPassword != password THEN
        SET result = 'Mật khẩu sai:0';
    ELSE
        SET result = CONCAT('Đăng nhập thành công:', userId); -- Trả về cả trạng thái và ID
    END IF;

    RETURN result;
END$$

DELIMITER ;

DELIMITER $$

CREATE FUNCTION changePassword(
    userId INT, 
    currentPassword VARCHAR(255), 
    newPassword VARCHAR(255), 
    confirmPassword VARCHAR(255)
) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE storedPassword VARCHAR(255);
    DECLARE resultMessage VARCHAR(255);

    -- Lấy mật khẩu hiện tại từ cơ sở dữ liệu
    SELECT Mat_khau INTO storedPassword
    FROM NGUOI_DUNG
    WHERE ID = userId;

    -- Kiểm tra nếu không tìm thấy người dùng
    IF storedPassword IS NULL THEN
        SET resultMessage = 'Người dùng không tồn tại!';
    -- Kiểm tra mật khẩu hiện tại có khớp không
    ELSEIF storedPassword != currentPassword THEN
        SET resultMessage = 'Mật khẩu hiện tại không đúng!';
    -- Kiểm tra mật khẩu mới và xác nhận mật khẩu có khớp không
    ELSEIF newPassword != confirmPassword THEN
        SET resultMessage = 'Mật khẩu mới và xác nhận mật khẩu không khớp!';
    ELSE
        -- Cập nhật mật khẩu mới
        UPDATE NGUOI_DUNG 
        SET Mat_khau = newPassword 
        WHERE ID = userId;

        SET resultMessage = 'Mật khẩu đã được cập nhật thành công!';
    END IF;

    RETURN resultMessage;
END$$

DELIMITER ;

-- Quoc Anh

DELIMITER //


-- Đăng ký tài khoản
CREATE DEFINER="avnadmin"@"%" FUNCTION "signUp"(username VARCHAR(255), password VARCHAR(255)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
    DECLARE userId INT;
    
    -- Lấy mật khẩu từ database
    SELECT ID INTO userId 
    FROM NGUOI_DUNG 
    WHERE Ten_dang_nhap = username;
    
    IF userId IS NULL THEN
		INSERT INTO NGUOI_DUNG (Ten_dang_nhap, Mat_khau) VALUES (username, password);
        RETURN 'Đăng ký thành công';
    ELSE
        RETURN 'Tài khoản đã được tạo trước! Hãy đổi lại tên người dùng';
    END IF;
END;


-- Lấy toàn bộ quảng cáo
CREATE DEFINER="avnadmin"@"%" PROCEDURE "getAllAdvertisements"()
BEGIN
	SELECT * FROM (NHA_QUANG_CAO ad JOIN HOP_DONG_QUANG_CAO con 
    ON ad.ID = con.ID_nha_quang_cao);
END //

-- Lây toàn bộ quảng cáo có hiệu lực
CREATE DEFINER="avnadmin"@"%" PROCEDURE "getAllAdvertisementsInEffect"()
BEGIN
	SELECT * FROM (NHA_QUANG_CAO ad JOIN HOP_DONG_QUANG_CAO con 
					ON ad.ID = con.ID_nha_quang_cao)
	WHERE con.Ngay_bat_dau < NOW() AND con.Ngay_ket_thuc > NOW();
END //

-- Lấy toàn bộ nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" PROCEDURE "getAllAdvertisers"()
BEGIN
	SELECT * FROM NHA_QUANG_CAO;
END //

DELIMITER //
-- Thêm một nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" FUNCTION "addAdvertiser"(nameCompany VARCHAR(255), description VARCHAR(512)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
    DECLARE compID INT;
    
    -- Lấy mật khẩu từ database
    SELECT ID INTO compID 
    FROM NHA_QUANG_CAO 
    WHERE Ten_don_vi_quang_cao = nameCompany;
    
    IF compID IS NULL THEN
		INSERT INTO NHA_QUANG_CAO (Ten_don_vi_quang_cao, Mo_ta) VALUES (nameCompany, description);
        RETURN 'Nhà quảng cáo được thêm thành công';
    ELSE
        RETURN 'Nhà quảng cáo đã có trên hệ thống';
    END IF;
END //
DELIMITER ;

-- Xem một nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" PROCEDURE "selectAdvertiser"(IDAdv INT)
BEGIN    
    -- Lấy mật khẩu từ database
    SELECT * FROM NHA_QUANG_CAO WHERE ID=IDAdv;
END //

DELIMITER //
-- Sửa một nhà quảng cáo
CREATE FUNCTION modifyAdvertiser(IDAdv INT, name VARCHAR(255), des VARCHAR(512)) 
RETURNS VARCHAR(255) CHARSET utf8mb4
DETERMINISTIC
BEGIN
    DECLARE compID INT;
    
    -- Kiểm tra xem có nhà quảng cáo nào trùng tên không
    SELECT ID INTO compID
    FROM NHA_QUANG_CAO
    WHERE Ten_don_vi_quang_cao = name
    LIMIT 1;

    -- Nếu ID tìm thấy trùng với IDAdv, cho phép sửa
    IF compID = IDAdv OR compID IS NULL THEN
        UPDATE NHA_QUANG_CAO
        SET Ten_don_vi_quang_cao = name, Mo_ta = des 
        WHERE ID = IDAdv;
        RETURN 'Sửa thành công';
    ELSE
        RETURN 'Tên trùng với tên một nhà quảng cáo có sẵn';
    END IF;
END //

-- Lấy thông tin quảng cáo (trừ loại)
CREATE DEFINER="avnadmin"@"%" PROCEDURE "selectAdvertisement"(IDAdv INT)
BEGIN    
	SELECT * FROM HOP_DONG_QUANG_CAO con JOIN NHA_QUANG_CAO ads ON con.ID_nha_quang_cao=ads.ID WHERE con.ID=IDAdv;
END //

-- Lấy loại quảng cáo
CREATE DEFINER="avnadmin"@"%" FUNCTION "getAdsType"(id INT) RETURNS varchar(30) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
	DECLARE idQC INT;
	SELECT ID_quang_cao INTO idQC FROM QUANG_CAO_LOAI_1 WHERE ID_quang_cao=id;
	IF idQC is NULL THEN
		RETURN 'Thường';
	ELSE
		RETURN 'Premium';
	END IF;
END //

-- Lấy các nghệ sĩ của nhà quảng cáo premium
CREATE DEFINER="avnadmin"@"%" PROCEDURE "getArtistsForAdsType1"(idAd1 INT)
BEGIN
	SELECT Nghe_danh, Ngay_bat_dau, Ngay_ket_thuc 
                        FROM QUANG_CAO_LOAI_1_CHI_DINH_HOT_ARTIST JOIN NGHE_SI 
                        ON QUANG_CAO_LOAI_1_CHI_DINH_HOT_ARTIST.ID_hot_artist=NGHE_SI.ID
                        WHERE ID_quang_cao_loai_1=idAd1;
END //

-- Lấy các bài hát của nhà quảng cáo thường
CREATE DEFINER="avnadmin"@"%" PROCEDURE "getSongsForAdsType2"(idAd2 INT)
BEGIN
SELECT Ten_bai_hat, Ngay_bat_dau, Ngay_ket_thuc 
                        FROM QUANG_CAO_LOAI_2_CHI_DINH_BAI_HAT_THUONG JOIN BAI_HAT 
                        ON QUANG_CAO_LOAI_2_CHI_DINH_BAI_HAT_THUONG.ID_bai_hat_thuong=BAI_HAT.ID
                        WHERE ID_quang_cao_loai_2=idAd2;
END //


-- Thêm một hợp đồng quảng cáo
CREATE DEFINER=`avnadmin`@`%` FUNCTION `addAdvertisement`(
    advertiser VARCHAR(255), 
    startDate DATE, 
    endDate DATE, 
    adsType VARCHAR(5)
) RETURNS VARCHAR(255) CHARSET utf8mb4
DETERMINISTIC
BEGIN
    DECLARE idAdvertiser INT;
    DECLARE idAdvertisement INT;

    -- Attempt to find the advertiser ID
    SELECT ID INTO idAdvertiser 
    FROM NHA_QUANG_CAO 
    WHERE Ten_don_vi_quang_cao = advertiser;

    -- Handle case where no advertiser is found
    IF idAdvertiser IS NULL THEN
        RETURN 'Không có nhà quảng cáo này trong hệ thống';
    END IF;

    -- Validate start and end dates
    IF startDate >= endDate THEN
        RETURN 'Ngày bắt đầu phải đến trước ngày kết thúc';
    ELSEIF endDate < NOW() THEN
        RETURN 'Ngày kết thúc phải đến sau hiện tại';
    END IF;

    -- Insert a new advertisement contract
    INSERT INTO HOP_DONG_QUANG_CAO (Thoi_gian_hieu_luc_hop_dong, Ngay_bat_dau_quang_cao, ID_nha_quang_cao) 
    VALUES (startDate, endDate, idAdvertiser);

    -- Retrieve the ID of the newly inserted contract
    SELECT ID INTO idAdvertisement 
    FROM HOP_DONG_QUANG_CAO 
    WHERE Thoi_gian_hieu_luc_hop_dong = startDate AND Ngay_bat_dau_quang_cao = endDate AND ID_nha_quang_cao = idAdvertiser LIMIT 1;

    -- Insert into the appropriate advertisement type table
    IF adsType = 'L1' THEN
        INSERT INTO QUANG_CAO_LOAI_1 (ID_quang_cao) VALUES (idAdvertisement);
    ELSE
        INSERT INTO QUANG_CAO_LOAI_2 (ID_quang_cao) VALUES (idAdvertisement);
    END IF;

    -- Return success message
    RETURN CONCAT('Thêm hợp đồng thành công');
END //


-- Lấy các nghệ sĩ hot
CREATE DEFINER=`avnadmin`@`%` PROCEDURE `getAllHotArtists`() 
BEGIN
	SELECT Nghe_danh FROM (HOT_ARTIST hot JOIN NGHE_SI art ON hot.ID = art.ID); 
END //


-- Thêm nghệ sĩ hot vào quảng cáo loại 1
CREATE DEFINER=`avnadmin`@`%` FUNCTION `chooseArtistForAd`(IDAds INT, artist varchar(255)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC 
BEGIN
	DECLARE IDArt INT;
    DECLARE IDCheckCon INT;
    DECLARE startDate DATE;
    DECLARE endDate DATE;
    
	SELECT Ngay_bat_dau, Ngay_ket_thuc INTO startDate, endDate FROM HOP_DONG_QUANG_CAO WHERE ID=IDAds;
    SELECT ID_quang_cao INTO IDCheckCon FROM QUANG_CAO_LOAI_1 WHERE ID_quang_cao=IDAds;
    SELECT ID INTO IDArt FROM NGHE_SI WHERE Nghe_danh=artist;
    
    IF IDCheckCon IS NULL THEN
        RETURN 'Không phải quảng cáo premium';
	ELSE
		INSERT INTO QUANG_CAO_LOAI_1_CHI_DINH_ARTIST VALUES (IDAds, IDArt, startDate, endDate);
        RETURN 'Thêm nghệ sĩ thành công';
	END IF;
END //


DELIMITER ;
