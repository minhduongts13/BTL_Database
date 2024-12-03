DELIMITER $$

CREATE TRIGGER handle_premium_thue_bao_premium_basic
BEFORE INSERT ON THUE_BAO_PREMIUM
FOR EACH ROW
BEGIN
    -- Kiểm tra xem người dùng có thuê bao premium hiện tại không
    DECLARE current_expiry_date DATE;

    SELECT Ngay_ket_thuc INTO current_expiry_date
    FROM THUE_BAO_PREMIUM
    WHERE ID_nguoi_dung = NEW.ID_nguoi_dung AND Loai_thue_bao = 'Basic'
    ORDER BY Ngay_ket_thuc DESC
    LIMIT 1;

    -- Nếu có thuê bao hiện tại, dời ngày bắt đầu của gói mới
    IF current_expiry_date IS NOT NULL AND current_expiry_date > NEW.Ngay_bat_dau THEN
        SET NEW.Ngay_bat_dau = current_expiry_date + INTERVAL 1 DAY;
        SET NEW.Ngay_ket_thuc = NEW.Ngay_bat_dau + INTERVAL 30 DAY;
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER handle_premium_thue_bao_premium_standard
BEFORE INSERT ON THUE_BAO_PREMIUM
FOR EACH ROW
BEGIN
    -- Kiểm tra xem người dùng có thuê bao premium hiện tại không
    DECLARE current_expiry_date DATE;

    SELECT Ngay_ket_thuc INTO current_expiry_date
    FROM THUE_BAO_PREMIUM
    WHERE ID_nguoi_dung = NEW.ID_nguoi_dung AND Loai_thue_bao = 'Standard'
    ORDER BY Ngay_ket_thuc DESC
    LIMIT 1;

    -- Nếu có thuê bao hiện tại, dời ngày bắt đầu của gói mới
    IF current_expiry_date IS NOT NULL AND current_expiry_date > NEW.Ngay_bat_dau THEN
        SET NEW.Ngay_bat_dau = current_expiry_date + INTERVAL 1 DAY;
        SET NEW.Ngay_ket_thuc = NEW.Ngay_bat_dau + INTERVAL 30 DAY;
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER handle_premium_thue_bao_premium
BEFORE INSERT ON THUE_BAO_PREMIUM
FOR EACH ROW
BEGIN
    -- Kiểm tra xem người dùng có thuê bao premium hiện tại không
    DECLARE current_expiry_date DATE;

    SELECT Ngay_ket_thuc INTO current_expiry_date
    FROM THUE_BAO_PREMIUM
    WHERE ID_nguoi_dung = NEW.ID_nguoi_dung AND Loai_thue_bao = 'Premium'
    ORDER BY Ngay_ket_thuc DESC
    LIMIT 1;

    -- Nếu có thuê bao hiện tại, dời ngày bắt đầu của gói mới
    IF current_expiry_date IS NOT NULL AND current_expiry_date > NEW.Ngay_bat_dau THEN
        SET NEW.Ngay_bat_dau = current_expiry_date + INTERVAL 1 DAY;
        SET NEW.Ngay_ket_thuc = NEW.Ngay_bat_dau + INTERVAL 30 DAY;
    END IF;
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER after_update_band_status
AFTER UPDATE ON NHOM_NHAC
FOR EACH ROW
BEGIN
    -- Kiểm tra nếu trạng thái nhóm nhạc được cập nhật thành không hoạt động
    IF NEW.HoatDong = 0 AND OLD.HoatDong = 1 THEN
        -- Cập nhật tất cả các thành viên thuộc nhóm nhạc này
        UPDATE NGHE_SI
        SET ID_nhom_nhac = NULL
        WHERE ID_nhom_nhac = NEW.ID;
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER before_insert_comment
BEFORE UPDATE ON NOI_DUNG_BINH_LUAN
FOR EACH ROW
BEGIN
    IF NEW.Noidung REGEXP '.*(lgbt|gay|les).*' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Nội dung cập nhật vi phạm tiêu chuẩn cộng đồng.';
    END IF;
END$$

NGHE_NGUOI_DUNG_VIP
DELIMITER ;

DELIMITER $$

CREATE TRIGGER before_update_comment
BEFORE INSERT ON NOI_DUNG_BINH_LUAN
FOR EACH ROW
BEGIN
    IF NEW.Noidung REGEXP '.*(lgbt|gay|les).*' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Nội dung cập nhật vi phạm tiêu chuẩn cộng đồng.';
    END IF;
END$$

NGHE_NGUOI_DUNG_VIP
DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_insert_premium
AFTER INSERT ON THUE_BAO_PREMIUM
FOR EACH ROW
BEGIN
    -- Kiểm tra nếu gói thuê bao là Premium
    IF NOT EXISTS (
        SELECT 1 
        FROM NGHE_NGUOI_DUNG_VIP 
        WHERE ID_nguoi_dung_vip = NEW.ID_nguoi_dung) THEN
        -- Thêm vào bảng NGHE_NGUOI_DUNG
        INSERT INTO NGHE_NGUOI_DUNG_VIP (ID_Bai_hat_xin, ID_nguoi_dung_vip)
        SELECT ID_bai_hat, NEW.ID_nguoi_dung
        FROM BAI_HAT_XIN
        WHERE ID_bai_hat IS NOT NULL; -- Chỉ thêm bài hát hợp lệ
    END IF;
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER after_expiry_date
AFTER UPDATE ON THUE_BAO_PREMIUM
FOR EACH ROW
BEGIN
    -- Kiểm tra nếu ngày kết thúc đã trôi qua
    IF NEW.Ngay_ket_thuc < CURDATE() THEN
        -- Xóa các bản ghi liên quan trong bảng NGHE_NGUOI_DUNG_VIP
        DELETE FROM NGHE_NGUOI_DUNG_VIP
        WHERE ID_nguoi_dung = NEW.ID_nguoi_dung;
    END IF;
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER before_insert_bai_hat_thuoc_playlist
BEFORE INSERT ON BAI_HAT_THUOC_PLAYLIST
FOR EACH ROW
BEGIN
    -- Kiểm tra nếu bài hát không tồn tại
    IF NOT EXISTS (SELECT 1 FROM BAI_HAT WHERE ID = NEW.ID_Bai_hat) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: Title does not exist in BAI_HAT table.';
    END IF;
    -- Kiểm tra nếu playlist không tồn tại
    IF NOT EXISTS (SELECT 1 FROM PLAYLIST WHERE ID = NEW.ID_Playlist) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: Playlist does not exist for the given user_id.';
    END IF;
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_sign_up_user
AFTER INSERT ON NGUOI_DUNG
FOR EACH ROW
BEGIN
    INSERT INTO NGHE_NGUOI_DUNG_THUONG (ID_Bai_hat_thuong, ID_nguoi_dung_thuong)
    SELECT ID_bai_hat, NEW.ID
    FROM BAI_HAT_THUONG
    WHERE ID_bai_hat IS NOT NULL; -- Chỉ thêm bài hát hợp lệ
END$$

DELIMITER ;


DELIMITER $$

CREATE TRIGGER after_up_normal_song
AFTER INSERT ON BAI_HAT_THUONG
FOR EACH ROW
BEGIN
    INSERT INTO NGHE_NGUOI_DUNG_THUONG (ID_Bai_hat_thuong, ID_nguoi_dung_thuong)
    SELECT NEW.ID_bai_hat, ID_nguoi_dung_thuong
    FROM OLD.NGHE_NGUOI_DUNG_THUONG
    WHERE ID_nguoi_dung_thuong IS NOT NULL; -- Chỉ thêm người dùng hợp lệ
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_up_vip_song
AFTER INSERT ON BAI_HAT_XIN
FOR EACH ROW
BEGIN
    -- Chèn dữ liệu, bỏ qua nếu đã tồn tại
    INSERT IGNORE INTO NGHE_NGUOI_DUNG_VIP (ID_Bai_hat_xin, ID_nguoi_dung_vip)
    SELECT NEW.ID_bai_hat, ID_nguoi_dung
    FROM THUE_BAO_PREMIUM
    WHERE ID_nguoi_dung IS NOT NULL;
END$$

DELIMITER ;