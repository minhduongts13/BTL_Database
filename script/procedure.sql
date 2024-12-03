USE ass2;




DELIMITER //
CREATE PROCEDURE AddSongToPlaylist(
    IN p_user_id INT,
    IN p_title VARCHAR(255)
)
BEGIN
    DECLARE v_song_id INT;
    DECLARE v_playlist_id INT;
    
    -- Get the ID of the song
    SELECT ID INTO v_song_id
    FROM BAI_HAT
    WHERE Ten_bai_hat = p_title;
    
    -- Get the ID of the playlist
    SELECT ID INTO v_playlist_id
    FROM PLAYLIST
    WHERE ID_nguoi_dung = p_user_id;
    
    -- Insert the song into the playlist
    INSERT INTO BAI_HAT_THUOC_PLAYLIST (ID_Bai_hat, ID_Playlist)
    VALUES (v_song_id, v_playlist_id);
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE GetAlbumDetails(
    IN p_album_id INT
)
BEGIN
    SELECT *
    FROM ALBUM
    LEFT JOIN NHA_PHAT_HANH ON ALBUM.ID_nha_phat_hanh = NHA_PHAT_HANH.ID
    LEFT JOIN NHOM_NHAC ON ALBUM.ID_nhom_nhac = NHOM_NHAC.ID
    LEFT JOIN NGHE_SI ON ALBUM.ID_ca_si = NGHE_SI.ID
    WHERE ALBUM.ID = p_album_id;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE DeleteSongFromPlaylist(
    IN p_id INT
)
BEGIN
    DELETE FROM BAI_HAT_THUOC_PLAYLIST
    WHERE ID_Bai_hat = p_id;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE GetSongsInUserPlaylists(
    IN p_user_id INT
)
BEGIN
    SELECT *
    FROM BAI_HAT
    WHERE ID IN (
        SELECT ID_Bai_hat
        FROM BAI_HAT_THUOC_PLAYLIST
        WHERE ID_Playlist IN (
            SELECT ID
            FROM PLAYLIST
            WHERE ID_nguoi_dung = p_user_id
        )
    );
END //

DELIMITER ;



DELIMITER $$

CREATE PROCEDURE getValidSubscription(IN userId INT)
BEGIN
    -- Trả về subscription còn hạn của người dùng
    SELECT 
        Ngay_bat_dau,
        Ngay_ket_thuc,
        Loai_thue_bao,
        Gia_goc,
        Thong_tin_thanh_toan,
        ID_voucher
    FROM THUE_BAO_PREMIUM
    WHERE ID_nguoi_dung = userId
      AND Ngay_ket_thuc >= CURDATE() AND Ngay_bat_dau <= CURDATE() -- Kiểm tra subscription còn hạn
    LIMIT 1; -- Lấy một entry
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addSubscription(
    IN p_user_id INT,
    IN p_start_date DATE,
    IN p_end_date DATE,
    IN p_type VARCHAR(255),
    IN p_purchase VARCHAR(255),
    IN p_base_price INT,
    IN p_voucher_id INT
)
BEGIN
    -- Kiểm tra trùng lặp với các thuê bao đã tồn tại
    -- IF EXISTS (
--         SELECT 1
--         FROM THUE_BAO_PREMIUM
--         WHERE ID_nguoi_dung = p_user_id
--           AND (
--               (p_start_date > p_end_date)
--               OR (p_start_date < curdate())
--               OR (p_start_date BETWEEN Ngay_bat_dau AND Ngay_ket_thuc)
--               OR (p_end_date BETWEEN Ngay_bat_dau AND Ngay_ket_thuc)
--               OR (Ngay_bat_dau BETWEEN p_start_date AND p_end_date)
--               
--           )
--     ) THEN
--         SIGNAL SQLSTATE '45000'
--         SET MESSAGE_TEXT = 'Khoảng thời gian không hợp lệ hoặc đã trùng với thuê bao đã mua.';
--     ELSE
        -- Thêm mới thuê bao
        INSERT INTO THUE_BAO_PREMIUM  (Ngay_bat_dau, Ngay_ket_thuc, Loai_thue_bao, Gia_goc, Thoi_gian_thanh_toan, Thong_tin_thanh_toan, ID_nguoi_dung, ID_voucher)
        VALUES (p_start_date, p_end_date, p_type, p_base_price, curdate(), p_purchase, p_user_id, p_voucher_id);
    -- END IF; 
END$$

DELIMITER ;




-- Truy van 1
DELIMITER $	

CREATE PROCEDURE GetTop5SongsByArtist(
  IN ID_nghe_si int
)
BEGIN
    SELECT  DISTINCT BAI_HAT.ID AS ID_Bai_Hat,
		 BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat, 
		 BAI_HAT.Luot_nghe AS Luot_Nghe, 
 		 BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh  
    FROM  CA_SI, NHAC_SI, NHA_SAN_XUAT_AM_NHAC NSXAN, 
          CA_SI_THE_HIEN_BAI_HAT CS_BH, NHAC_SI_THE_HIEN_BAI_HAT NS_BH, BAI_HAT
    WHERE (ID_nghe_si = CS_BH.ID_ca_si AND CS_BH.ID_bai_hat=BAI_HAT.ID) OR
			(ID_nghe_si = NS_BH.ID_nhac_si AND NS_BH.ID_bai_hat=BAI_HAT.ID) OR
            (ID_nghe_si=NSXAN.ID AND NSXAN.ID=BAI_HAT.ID_nha_san_xuat_am_nhac)
    ORDER BY BAI_HAT.Luot_nghe DESC
    LIMIT 5;
END $
DELIMITER ; 


-- Truy van 2

DELIMITER $	

CREATE PROCEDURE GetTop5AristByPublisher(
  IN ID_cua_nha_phat_hanh int
)
BEGIN
    SELECT 	NGHE_SI.ID AS ID_Nghe_Si,
			NGHE_SI.Nghe_danh AS Nghe_Danh, 
 			NGHE_SI.Ho AS Ho_Nghe_Si,
            NGHE_SI.Ten AS Ten_Nghe_Si,
            sum(BAI_HAT.Luot_nghe) AS Tong_Luot_Nghe,
            sum(case when BAI_HAT.Ngay_phat_hanh >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) then BAI_HAT.Luot_nghe else 0 end) AS Tong_Luot_Nghe_Bai_Hat_Gan_Day,
            count(BAI_HAT.ID) AS So_Luong_Bai_Hat
    FROM NGHE_SI, BAI_HAT
	WHERE CONCAT (NGHE_SI.ID, '-', BAI_HAT.ID) IN (SELECT  DISTINCT CONCAT (NGHE_SI.ID, '-', BAI_HAT.ID)
												FROM NGHE_SI, NHA_SAN_XUAT_AM_NHAC NSXAN, 
													  CA_SI_THE_HIEN_BAI_HAT CS_BH, NHAC_SI_THE_HIEN_BAI_HAT NS_BH, BAI_HAT
												WHERE ID_cua_nha_phat_hanh=NGHE_SI.ID_nha_phat_hanh AND 
														((NGHE_SI.ID=CS_BH.ID_ca_si AND CS_BH.ID_bai_hat=BAI_HAT.ID) OR
														(NGHE_SI.ID=NS_BH.ID_nhac_si AND NS_BH.ID_bai_hat=BAI_HAT.ID) OR
														(NGHE_SI.ID=NSXAN.ID AND NSXAN.ID=BAI_HAT.ID_nha_san_xuat_am_nhac)))
    GROUP BY NGHE_SI.ID
    HAVING So_Luong_Bai_Hat > 0
    ORDER BY Tong_Luot_Nghe_Bai_Hat_Gan_Day DESC
    LIMIT 5;
END $
DELIMITER ; 



-- Search


-- Thu tuc tim bai hat tu ten va the loai
DELIMITER $	

CREATE PROCEDURE SearchSongsByNameAndGenre(
  IN IN_Ten_Bai_Hat varchar(255),
  IN IN_The_Loai varchar(255)
)
BEGIN
    SELECT  DISTINCT BAI_HAT.ID AS ID_Bai_Hat,
			BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat,
			BAI_HAT.Luot_nghe AS Luot_Nghe,
            BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh
    FROM  BAI_HAT, THE_LOAI_BAI_HAT
    WHERE (BAI_HAT.Ten_bai_hat LIKE CONCAT('%', IN_Ten_Bai_Hat , '%')) AND (BAI_HAT.ID=THE_LOAI_BAI_HAT.ID_Bai_hat)
			AND (THE_LOAI_BAI_HAT.The_loai LIKE CONCAT('%', IN_The_Loai , '%'))
	ORDER BY BAI_HAT.Luot_nghe DESC;
END $
DELIMITER ; 

-- Thu tuc tim nghe si dua tren ID bai hat
DELIMITER $	

CREATE PROCEDURE SearchArtistsBySong(
  IN IN_ID_Bai_Hat int
)
BEGIN
    SELECT  DISTINCT NGHE_SI.ID AS ID_Nghe_Si,
			NGHE_SI.Nghe_danh AS Nghe_Danh,
			NGHE_SI.Ho AS Ho_Nghe_Si,
            NGHE_SI.Ten AS Ten_Nghe_Si
    FROM NGHE_SI, 
          CA_SI_THE_HIEN_BAI_HAT CS_BH, NHAC_SI_THE_HIEN_BAI_HAT NS_BH, BAI_HAT
    WHERE (BAI_HAT.ID = IN_ID_Bai_Hat) AND 
			((NGHE_SI.ID = CS_BH.ID_ca_si AND BAI_HAT.ID = CS_BH.ID_bai_hat) OR
			(NGHE_SI.ID = NS_BH.ID_nhac_si AND BAI_HAT.ID = NS_BH.ID_bai_hat) OR
            (NGHE_SI.ID = BAI_HAT.ID_nha_san_xuat_am_nhac))
	ORDER BY NGHE_SI.ID;
END $
DELIMITER ; 

-- Thu tuc hien thi playlist
DELIMITER $	

CREATE PROCEDURE GetPlaylistByUser(
  IN IN_ID_nguoi_dung int
)
BEGIN
   SELECT * FROM BAI_HAT 
   WHERE ID IN 
				(SELECT ID_Bai_hat 
                FROM BAI_HAT_THUOC_PLAYLIST 
                WHERE ID_Playlist 
                IN (SELECT ID FROM PLAYLIST WHERE ID_nguoi_dung = IN_ID_nguoi_dung));
	
END $
DELIMITER ; 

-- Thu tuc tim bai hat theo ten va the loai tu playlist của một người dùng
DELIMITER $	

CREATE PROCEDURE SearchSongsByNameAndGenreOfPlaylist(
  IN IN_Ten_Bai_Hat varchar(255),
  IN IN_The_Loai varchar(255),
  IN IN_ID_Nguoi_Dung int
)
BEGIN

    SELECT  DISTINCT BAI_HAT.ID AS ID_Bai_Hat,
			BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat,
			BAI_HAT.Luot_nghe AS Luot_Nghe,
            BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh
    FROM  BAI_HAT, THE_LOAI_BAI_HAT
    WHERE (BAI_HAT.Ten_bai_hat LIKE CONCAT('%', IN_Ten_Bai_Hat , '%')) AND (BAI_HAT.ID=THE_LOAI_BAI_HAT.ID_Bai_hat)
			AND (THE_LOAI_BAI_HAT.The_loai LIKE CONCAT('%', IN_The_Loai , '%')) 
            AND (BAI_HAT.ID IN (SELECT ID_Bai_hat 
								FROM BAI_HAT_THUOC_PLAYLIST 
								WHERE ID_Playlist 
								IN (SELECT ID FROM PLAYLIST WHERE ID_nguoi_dung = IN_ID_nguoi_dung)))
	ORDER BY BAI_HAT.Luot_nghe DESC;
END $
DELIMITER ; 

--  Thu tuc tim bai hat theo ten tu playlist của một người dùng
DELIMITER $	

CREATE PROCEDURE SearchSongsByNameOfPlaylist(
  IN IN_Ten_Bai_Hat varchar(255),
  IN IN_ID_Nguoi_Dung int
)
BEGIN

    SELECT  DISTINCT BAI_HAT.ID AS ID_Bai_Hat,
			BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat,
			BAI_HAT.Luot_nghe AS Luot_Nghe,
            BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh
    FROM  BAI_HAT
    WHERE (BAI_HAT.Ten_bai_hat LIKE CONCAT('%', IN_Ten_Bai_Hat , '%'))
            AND (BAI_HAT.ID IN (SELECT ID_Bai_hat 
								FROM BAI_HAT_THUOC_PLAYLIST 
								WHERE ID_Playlist 
								IN (SELECT ID FROM PLAYLIST WHERE ID_nguoi_dung = IN_ID_nguoi_dung)))
	ORDER BY BAI_HAT.Luot_nghe DESC;
END $
DELIMITER ; 



-- Search
-- Thu tuc tim bai hat tu ten
DELIMITER $	

CREATE PROCEDURE SearchSongsByName(
  IN IN_Ten_Bai_Hat varchar(255)
)
BEGIN
    SELECT  DISTINCT BAI_HAT.ID AS ID_Bai_Hat,
			BAI_HAT.Ten_bai_hat AS Ten_Bai_Hat,
			BAI_HAT.Luot_nghe AS Luot_Nghe,
            BAI_HAT.Ngay_phat_hanh AS Ngay_Phat_Hanh
    FROM  BAI_HAT
    WHERE (BAI_HAT.Ten_bai_hat LIKE CONCAT('%', IN_Ten_Bai_Hat , '%'))
	ORDER BY BAI_HAT.Luot_nghe DESC;
END $
DELIMITER ; 

-- Thu tuc tim nghe si tu ten 
DELIMITER $	

CREATE PROCEDURE SearchArtistsByName(
  IN IN_Ten_Nghe_Si varchar(255)
)
BEGIN
    SELECT  DISTINCT NGHE_SI.ID AS ID_Nghe_Si,
			NGHE_SI.Nghe_danh AS Nghe_Danh,
			NGHE_SI.Ho AS Ho_Nghe_Si,
            NGHE_SI.Ten AS Ten_Nghe_Si
    FROM  NGHE_SI
    WHERE (NGHE_SI.Nghe_danh LIKE CONCAT('%', IN_Ten_Nghe_Si , '%')) OR
		  (CONCAT(NGHE_SI.Ho,' ',NGHE_SI.Ten) LIKE CONCAT('%', IN_Ten_Nghe_Si , '%'))
	ORDER BY NGHE_SI.ID;
END $
DELIMITER ; 

-- Thu tuc tim album tu ten 
DELIMITER $	

CREATE PROCEDURE SearchAlbumsByName(
  IN IN_Ten_Album varchar(255)
)
BEGIN
    SELECT  DISTINCT ALBUM.ID AS ID_Album,
			ALBUM.Ten_album AS Ten_Album,
			ALBUM.Ngay_phat_hanh AS Ngay_Phat_Hanh
    FROM  ALBUM
    WHERE (ALBUM.Ten_album LIKE CONCAT('%', IN_Ten_Album , '%'))
	ORDER BY ALBUM.Ngay_phat_hanh DESC;
END $
DELIMITER ; 




