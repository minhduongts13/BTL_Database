


-- Tables with no dependencies first
CREATE TABLE NHA_PHAT_HANH (
    ID INT AUTO_INCREMENT,
    Ten_nha_phat_hanh VARCHAR(255) NOT NULL,
    Ngay_thanh_lap DATE NOT NULL,
	PRIMARY KEY (ID),
    CONSTRAINT check_ngay_thanh_lap CHECK (Ngay_thanh_lap < '2024-12-01')
);

CREATE TABLE NHA_QUANG_CAO (
    ID INT AUTO_INCREMENT,
    Mo_ta TEXT,
    -- Hop_dong_hien_co VARCHAR(255),
    Ten_don_vi_quang_cao VARCHAR(255) NOT NULL, 
    PRIMARY KEY (ID)
);

CREATE TABLE NGUOI_DUNG (
	ID INT AUTO_INCREMENT,
    Ten_dang_nhap VARCHAR(255) NOT NULL UNIQUE,
    Mat_khau VARCHAR(255) NOT NULL,
    CONSTRAINT check_mat_khau CHECK (
        Mat_khau REGEXP '^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$'
    ),
	PRIMARY KEY (ID)
);

-- Dependent tables follow
CREATE TABLE NHOM_NHAC (
	ID INT AUTO_INCREMENT,
    Mo_ta TEXT,
    Ngay_thanh_lap DATE,
    Ten_nhom_nhac VARCHAR(255),
    ID_nha_phat_hanh INT,
    HoatDong BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_nha_phat_hanh) REFERENCES NHA_PHAT_HANH(ID)
);

CREATE TABLE NGHE_SI (
    ID INT AUTO_INCREMENT,
    Nghe_danh VARCHAR(255) NOT NULL,
    Mo_ta TEXT,
    Ho VARCHAR(255),
    Ten VARCHAR(255),
    ID_nha_phat_hanh INT NOT NULL,
    ID_nhom_nhac INT,
	PRIMARY KEY (ID),
    FOREIGN KEY (ID_nha_phat_hanh) REFERENCES NHA_PHAT_HANH(ID),
    FOREIGN KEY (ID_nhom_nhac) REFERENCES NHOM_NHAC(ID)
);

CREATE TABLE CA_SI (
    ID INT ,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES NGHE_SI(ID)
);

CREATE TABLE NHAC_SI (
    ID INT ,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES NGHE_SI(ID)
);

CREATE TABLE NHA_SAN_XUAT_AM_NHAC (
    ID INT ,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES NGHE_SI(ID)
);

CREATE TABLE HOT_ARTIST(
	ID INT ,
	PRIMARY KEY (ID),
	FOREIGN KEY (ID) REFERENCES NGHE_SI(ID)
);

CREATE TABLE HOP_DONG_QUANG_CAO(
	ID INT AUTO_INCREMENT,
    Thoi_gian_hieu_luc_hop_dong DATE NOT NULL,
    Ngay_bat_dau_quang_cao DATE NOT NULL,
    ID_nha_quang_cao INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_nha_quang_cao) REFERENCES NHA_QUANG_CAO(ID),
    CONSTRAINT check_thoi_han_hop_dong CHECK (
        DATEDIFF(Thoi_gian_hieu_luc_hop_dong, Ngay_bat_dau_quang_cao) <= 730
    )
);

CREATE TABLE QUANG_CAO_LOAI_1(
	ID_quang_cao INT ,
    PRIMARY KEY (ID_quang_cao),
    FOREIGN KEY (ID_quang_cao) REFERENCES HOP_DONG_QUANG_CAO(ID)
);

CREATE TABLE QUANG_CAO_LOAI_2(
	ID_quang_cao INT,
    PRIMARY KEY (ID_quang_cao),
    FOREIGN KEY (ID_quang_cao) REFERENCES HOP_DONG_QUANG_CAO(ID)
);

CREATE TABLE ALBUM(
	ID INT AUTO_INCREMENT,
    Ten_album VARCHAR(255) NOT NULL,
    Ngay_phat_hanh DATE NOT NULL,
    ID_nhom_nhac INT,
    ID_nha_phat_hanh INT,
    ID_ca_si INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_nhom_nhac) REFERENCES NHOM_NHAC(ID),
    FOREIGN KEY (ID_nha_phat_hanh) REFERENCES NHA_PHAT_HANH(ID),
    FOREIGN KEY (ID_ca_si) REFERENCES CA_SI(ID)
);

CREATE TABLE BAI_HAT (
    ID INT AUTO_INCREMENT,
    Ten_bai_hat VARCHAR(255) NOT NULL,
    Mo_ta_bai_hat TEXT,
    Luot_nghe INT DEFAULT 0,
    Ngay_phat_hanh DATE NOT NULL,
    Thoi_luong TIME NOT NULL,
    Loi_bai_hat TEXT ,
    ID_album INT,
    ID_nha_phat_hanh INT NOT NULL,
    ID_nha_san_xuat_am_nhac INT,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID_album) REFERENCES ALBUM(ID),
    FOREIGN KEY (ID_nha_phat_hanh) REFERENCES NHA_PHAT_HANH(ID),
    FOREIGN KEY (ID_nha_san_xuat_am_nhac) REFERENCES NHA_SAN_XUAT_AM_NHAC(ID),
    CONSTRAINT check_thoi_luong CHECK (TIME_TO_SEC(Thoi_luong) <= 600)
);

CREATE TABLE BAI_HAT_XIN(
	ID_bai_hat INT ,
	PRIMARY KEY (ID_bai_hat),
	FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID)
);

CREATE TABLE BAI_HAT_THUONG(
	ID_bai_hat INT ,
	PRIMARY KEY (ID_bai_hat),
	FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID)
);

CREATE TABLE THE_LOAI_BAI_HAT (
    ID_Bai_hat INT,
    The_loai VARCHAR(255),
    PRIMARY KEY (ID_Bai_hat, The_loai),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BAI_HAT(ID)
);

CREATE TABLE CREDIT_BAI_HAT (
    ID_bai_hat INT,
    Credit NVARCHAR(255),
    PRIMARY KEY (ID_bai_hat, Credit),
    FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID)
);

CREATE TABLE CA_SI_THE_HIEN_BAI_HAT(
	ID_bai_hat INT ,
	ID_ca_si INT,
    PRIMARY KEY (ID_bai_hat, ID_ca_si),
    FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_ca_si) REFERENCES CA_SI(ID)
);

CREATE TABLE NHAC_SI_THE_HIEN_BAI_HAT(
	ID_bai_hat INT,
	ID_nhac_si INT,
    PRIMARY KEY (ID_bai_hat, ID_nhac_si),
    FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_nhac_si) REFERENCES NHAC_SI(ID)
    
);

CREATE TABLE NHOM_NHAC_THE_HIEN_BAI_HAT(
	ID_bai_hat INT,
	ID_nhom_nhac INT,
    PRIMARY KEY (ID_bai_hat, ID_nhom_nhac),
    FOREIGN KEY (ID_bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_nhom_nhac) REFERENCES NHOM_NHAC(ID)
);

CREATE TABLE BINH_LUAN (
    ID_Bai_hat INT,
    ID_nguoi_dung INT,
    PRIMARY KEY (ID_Bai_hat, ID_nguoi_dung),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES NGUOI_DUNG(ID)
);

CREATE TABLE NOI_DUNG_BINH_LUAN (
    ID_Bai_hat INT,
    ID_nguoi_dung INT,
    Noidung VARCHAR(255),
    PRIMARY KEY (ID_Bai_hat, ID_nguoi_dung, Noidung),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BINH_LUAN(ID_Bai_hat),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES BINH_LUAN(ID_nguoi_dung)
);

CREATE TABLE VOUCHER (
    ID INT AUTO_INCREMENT,
    Ngay_bat_dau DATE NOT NULL,
    Ngay_ket_thuc DATE NOT NULL,
    Gia_tri INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE THUE_BAO_PREMIUM (
    Ngay_bat_dau DATE NOT NULL,
    Ngay_ket_thuc DATE NOT NULL,
    Loai_thue_bao NVARCHAR(255),
    Gia_goc INT,
    Thoi_gian_thanh_toan DATE,
    Thong_tin_thanh_toan NVARCHAR(255),
    ID_nguoi_dung INT,
    ID_voucher INT,
    PRIMARY KEY (ID_nguoi_dung, Ngay_bat_dau),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES NGUOI_DUNG(ID),
    FOREIGN KEY (ID_voucher) REFERENCES VOUCHER(ID)
);

CREATE TABLE QUANG_CAO_LOAI_2_CHI_DINH_BAI_HAT_THUONG(
	ID_quang_cao_loai_2 INT,
	ID_bai_hat_thuong INT ,
    Ngay_bat_dau DATE,
    Ngay_ket_thuc DATE,
    PRIMARY KEY (ID_quang_cao_loai_2, ID_bai_hat_thuong),
    FOREIGN KEY (ID_quang_cao_loai_2) REFERENCES QUANG_CAO_LOAI_2(ID_quang_cao),
    FOREIGN KEY (ID_bai_hat_thuong) REFERENCES BAI_HAT_THUONG(ID_bai_hat)
);

CREATE TABLE NGHE_NGUOI_DUNG_VIP(
	ID_bai_hat_xin INT,
    ID_nguoi_dung_vip INT,
	PRIMARY KEY (ID_bai_hat_xin, ID_nguoi_dung_vip),
    FOREIGN KEY (ID_bai_hat_xin) REFERENCES BAI_HAT_XIN(ID_bai_hat),
	FOREIGN KEY (ID_nguoi_dung_vip) REFERENCES THUE_BAO_PREMIUM(ID_nguoi_dung)
);

CREATE TABLE NGHE_NGUOI_DUNG_THUONG(
	ID_Bai_hat_thuong INT,
    ID_nguoi_dung_thuong INT,
	PRIMARY KEY (ID_Bai_hat_thuong, ID_nguoi_dung_thuong),
	FOREIGN KEY (ID_Bai_hat_thuong) REFERENCES BAI_HAT_THUONG(ID_bai_hat),
    FOREIGN KEY (ID_nguoi_dung_thuong) REFERENCES NGUOI_DUNG(ID)
);

CREATE TABLE QUANG_CAO_LOAI_1_CHI_DINH_HOT_ARTIST(
	ID_quang_cao_loai_1 INT,
	ID_hot_artist INT ,
    Ngay_bat_dau DATE,
    Ngay_ket_thuc DATE,
    PRIMARY KEY (ID_quang_cao_loai_1, ID_hot_artist),
    FOREIGN KEY (ID_quang_cao_loai_1) REFERENCES QUANG_CAO_LOAI_1(ID_quang_cao),
    FOREIGN KEY (ID_hot_artist) REFERENCES HOT_ARTIST(ID)
);

CREATE TABLE PLAYLIST (
    ID INT AUTO_INCREMENT,
    LinkShare VARCHAR(255),
    Ten_playlist VARCHAR(255),
    Ngay_lap DATE,
    ID_nguoi_dung INT,
    PRIMARY KEY (ID, LinkShare),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES NGUOI_DUNG(ID)
);

CREATE TABLE BAI_HAT_THUOC_PLAYLIST (
    ID_Bai_hat INT,
    ID_Playlist INT,
    PRIMARY KEY (ID_Bai_hat, ID_Playlist),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_Playlist) REFERENCES PLAYLIST(ID)
);

CREATE TABLE BAN_BE (
    ID_nguoi_dung_1 INT, 
    ID_nguoi_dung_2 INT,
    PRIMARY KEY (ID_nguoi_dung_1, ID_nguoi_dung_2),
    FOREIGN KEY (ID_nguoi_dung_1) REFERENCES NGUOI_DUNG(ID),
    FOREIGN KEY (ID_nguoi_dung_2) REFERENCES NGUOI_DUNG(ID)
);

CREATE TABLE RATE (
    ID_Bai_hat INT,
    ID_nguoi_dung INT,
    Diem INT,
    PRIMARY KEY (ID_Bai_hat, ID_nguoi_dung),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES NGUOI_DUNG(ID),
    CONSTRAINT Diem CHECK (Diem BETWEEN 0 AND 5)
);

CREATE TABLE THICH (
    ID_Bai_hat INT,
    ID_nguoi_dung INT,
    PRIMARY KEY (ID_Bai_hat, ID_nguoi_dung),
    FOREIGN KEY (ID_Bai_hat) REFERENCES BAI_HAT(ID),
    FOREIGN KEY (ID_nguoi_dung) REFERENCES NGUOI_DUNG(ID)
);

CREATE TABLE THE_LOAI_ALBUM(
	ID_Album INT,
    The_loai VARCHAR(255),
    PRIMARY KEY (ID_Album, The_loai),
    FOREIGN KEY (ID_Album) REFERENCES ALBUM(ID)
);