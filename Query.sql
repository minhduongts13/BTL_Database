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


-- Thêm một nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" FUNCTION "addAdvertiser"(nameCompany VARCHAR(255), description VARCHAR(512)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
    DECLARE compID INT;
    
    -- Lấy mật khẩu từ database
    SELECT ID INTO compId 
    FROM NHA_QUANG_CAO 
    WHERE Ten_don_vi_quang_cao = nameCompany;
    
    IF userId IS NULL THEN
		INSERT INTO NHA_QUANG_CAO (Ten_don_vi_quang_cao, Mo_ta) VALUES (nameCompany, description);
        RETURN 'Nhà quảng cáo được thêm thành công';
    ELSE
        RETURN 'Nhà quảng cáo đã có trên hệ thống';
    END IF;
END //


-- Xem một nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" PROCEDURE "selectAdvertiser"(IDAdv INT)
BEGIN    
    -- Lấy mật khẩu từ database
    SELECT * FROM NHA_QUANG_CAO WHERE ID=IDAdv;
END //


-- Sửa một nhà quảng cáo
CREATE DEFINER="avnadmin"@"%" FUNCTION "modifyAdvertiser"(IDAdv INT, name varchar(255), des varchar(512)) RETURNS varchar(255) CHARSET utf8mb4
    DETERMINISTIC
BEGIN    
	SELECT ID INTO compID 
    FROM NHA_QUANG_CAO 
    WHERE Ten_don_vi_quang_cao = name;


    -- Lấy mật khẩu từ database
    IF compID = IDAdv THEN
		UPDATE NHA_QUANG_CAO
        SET Ten_don_vi_quang_cao=name, Mo_ta=des WHERE ID=IDAdv;
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
    INSERT INTO HOP_DONG_QUANG_CAO (Ngay_bat_dau, Ngay_ket_thuc, ID_nha_quang_cao) 
    VALUES (startDate, endDate, idAdvertiser);

    -- Retrieve the ID of the newly inserted contract
    SELECT ID INTO idAdvertisement 
    FROM HOP_DONG_QUANG_CAO 
    WHERE Ngay_bat_dau = startDate AND Ngay_ket_thuc = endDate AND ID_nha_quang_cao = idAdvertiser;

    -- Insert into the appropriate advertisement type table
    IF adsType = 'L1' THEN
        INSERT INTO QUANG_CAO_LOAI_1 (ID_hop_dong) VALUES (idAdvertisement);
    ELSE
        INSERT INTO QUANG_CAO_LOAI_2 (ID_hop_dong) VALUES (idAdvertisement);
    END IF;

    -- Return success message
    RETURN CONCAT('Thêm hợp đồng thành công:', idAdvertisement);
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