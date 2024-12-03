

INSERT INTO NHA_PHAT_HANH (Ten, Ngay_thanh_lap)
VALUES
('Phat Hanh Tre', '2000-05-15'),
('Nha Sach Thanh Nien', '1995-07-20'),
('Dai Phat Thanh Dan Viet', '1987-03-10'),
('Am Nhac Van Hoa', '2003-08-25'),
('Phat Hanh Viet Nghe', '2010-12-05'),
('San Xuat Nghe Thuat', '1998-09-12'),
('Phat Hanh Mo Uoc', '2005-01-18'),
('Am Nhac To Quoc', '2015-06-22'),
('Nha Sach Am Nhac', '2020-11-30'),
('Cong Ty Phat Hanh Xanh', '2018-04-14');

INSERT INTO NHOM_NHAC (Mo_ta, Ngay_thanh_lap, Ten_nhom_nhac, ID_nha_phat_hanh)
VALUES
('Nhom nhac phong cach tre trung', '2012-08-15', 'Tre Xanh', 9),
('Ban nhac bieu dien nhac tru tinh', '2010-03-20', 'Hoa Ca', 8),
('Nhom nhac the loai pop-rock', '2008-07-05', 'Sao Mai', 2),
('Ban nhac truyen thong Viet Nam', '2015-12-10', 'Que Huong', 3);

INSERT INTO NGHE_SI (Nghe_danh, Mo_ta, Ho, Ten, ID_nha_phat_hanh, ID_nhom_nhac)
VALUES
('SkyOi', NULL, 'Vo', 'Hoa', 3, 4),
('SangSao', 'Phong cach nhac dien tu', NULL, NULL, 6, NULL),
('MatTroi', 'Chuyen gia nhac pop', 'Hoang', NULL, 8, 2),
('DaiDuong', 'Nghe si da the loai', 'Pham', 'Dung', 9, 1),
('AnhTrang', NULL, NULL, 'Minh', 1, NULL),
('BeCon', NULL, NULL, NULL, 2, 3),
('Star', 'Thanh vien moi vo nhom nhac nhung noi tieng doi voi gioi tre', 'Tran', 'Phuc', 2, 3),
('MiNhon', 'Nhom nhac phong cach Viet', NULL, 'Hoa', 5, NULL),
('GiacMo', 'Nghe si doc dao', NULL, NULL, 4, NULL),
('ChimXanh', 'Nhac si va ca si', 'Hoang', 'Quyen', 7, NULL),
('Tete', 'Rong ruoi dung pho', 'Nguyen', 'Duy', 2, NULL);

-- Insert into CA_SI
INSERT INTO CA_SI (ID)
VALUES
(5),
(7),
(4),
(9),
(11);

-- Insert into NHAC_SI
INSERT INTO NHAC_SI (ID)
VALUES
(10),
(6),
(8);

-- Insert into NHA_SAN_XUAT_AM_NHAC
INSERT INTO NHA_SAN_XUAT_AM_NHAC (ID)
VALUES
(2),
(1),
(3);



INSERT INTO ALBUM (Ten_album, Ngay_phat_hanh, ID_nhom_nhac, ID_nha_phat_hanh, ID_ca_si)
VALUES
('luy tre lang', '2024-03-15', 1, 9, 4), -- NPH 2
('tinh yeu moi', '2023-11-20', 1, 9, 4),
('tuoi tre nang dong', '2023-04-05', 3, 2, 7),
('thanh nien ta di len', '2022-09-18', 3, 2, 7), -- NPH 3
('pop80', '2023-07-12', 3, 2, 7),
('tuoi tre suc song moi', '2023-02-22', NULL, 2, 11),
('que huong viet nam ta', '2021-06-30', NULL, 4, 9), -- NPH 4
('tinh yeu tu do', '2020-08-14', NULL, 1, 5), -- Ca Si tu do
('chia tay khong dau den the', '2019-05-25', NULL, 1, 5),
('trai nghiem cuoc song moi', '2017-11-10', NULL, 2, 11);

INSERT INTO THE_LOAI_ALBUM (ID_Album, The_loai)
VALUES
-- Album 1: luy tre lang
(1, 'nhac que huong'),
(1, 'nhac truyen thong'),

-- Album 2: tinh yeu moi
(2, 'nhac tre'),
(2, 'pop'),

-- Album 3: tuoi tre nang dong
(3, 'nhac tre'),
(3, 'dance'),

-- Album 4: thanh nien ta di len
(4, 'nhac truyen thong'),
(4, 'nhac cach mang'),

-- Album 5: pop80
(5, 'pop'),
(5, 'nhac quoc te'),

-- Album 6: tuoi tre suc song moi
(6, 'nhac tre'),
(6, 'dance'),

-- Album 7: que huong viet nam ta
(7, 'nhac que huong'),
(7, 'nhac truyen thong'),

-- Album 8: tinh yeu tu do
(8, 'nhac tre'),
(8, 'nhac tinh cam'),

-- Album 9: chia tay khong dau den the
(9, 'nhac tinh cam'),
(9, 'pop'),

-- Album 10: trai nghiem cuoc song moi
(10, 'nhac tre'),
(10, 'nhac tinh cam'),
(10, 'nhac tru tinh');



INSERT INTO BAI_HAT (Ten_bai_hat, Mo_ta_bai_hat, Luot_nghe, Ngay_phat_hanh, Thoi_luong, Loi_bai_hat, ID_album, ID_nha_phat_hanh, ID_nha_san_xuat_am_nhac)
VALUES
-- Album 1: luy tre lang
('duyen que', 'Mot bai hat ve tinh yeu que huong', 2500, '2024-03-16', '00:03:45', 'Duyen que trao nhau', 1, 9, 2),
('ho tren dong', 'Cau chuyen ve nhung nguoi nong dan', 3400, '2024-03-17', '00:04:10', 'Ho len tren dong xanh', 1, 9, 1),

-- Album 2: tinh yeu moi
('con mua tuoi tre', 'Tinh yeu tuoi tre giua con mua', 1800, '2023-11-21', '00:03:50', 'Mot tinh yeu nho be', 2, 9, 3),
('nhung ngay dep nhat', 'Nhung ky niem tuoi tre', 2100, '2023-11-22', '00:04:00', 'Nhung ngay dep nhat ben em', 2, 9, 3),

-- Album 3: tuoi tre nang dong
('buoc nhay', 'Nhip song nang dong cua tuoi tre', 5000, '2023-04-06', '00:03:20', 'Buoc nhay tren san khau', 3, 2, 1),
('dem nhay', 'Mot dem vui cua tuoi tre', 4800, '2023-04-07', '00:03:35', 'Dem nhay voi ban be', 3, 2, 2),

-- Album 4: thanh nien ta di len
('loi song cach mang', 'Tinh than cach mang soi dong', 3700, '2022-09-19', '00:03:55', 'Dung len vi tuong lai', 4, 2, 3),
('anh sang tuong lai', 'Tinh than tuoi tre va ly tuong', 3200, '2022-09-20', '00:03:40', 'Anh sang dua toi di', 4, 2, 3),

-- Album 5: pop80
('tinh ca mua thu', 'Mot bai tinh ca nhe nhang', 2900, '2023-07-13', '00:03:30', 'Tinh ca mua thu xanh', 5, 2, 1),
('bai ca quoc te', 'Giai dieu quoc te cho moi nguoi', 3100, '2023-07-14', '00:03:25', 'Am thanh cua the gioi', 5, 2, 1),

-- Album 6: tuoi tre suc song moi
('danh thuc tuoi tre', 'Tinh yeu va nhiet huyet tuoi tre', 2300, '2023-02-23', '00:03:15', 'Danh thuc nhung giac mo', 6, 2, 2),
('gioi tre noi len', 'Tieng noi cua gioi tre hien dai', 2500, '2023-02-24', '00:03:50', 'Gioi tre noi len mot chuong moi', 6, 2, 3),

-- Album 7: que huong viet nam ta
('que huong toi', 'Ve dep lang que Viet Nam', 3800, '2021-07-01', '00:03:45', 'Que huong toi dep lam', 7, 4, 2),
('truyen thong ngan doi', 'Giai dieu truyen thong', 4200, '2021-07-02', '00:04:00', 'Truyen thong ngan doi ta', 7, 4, 3),

-- Album 8: tinh yeu tu do
('mot nua tinh yeu', 'Tinh yeu tu do va thang hoa', 2100, '2020-08-15', '00:03:55', 'Mot nua cho em', 8, 1, 2),
('anh va em', 'Tinh cam chan thanh giua doi thuong', 1900, '2020-08-16', '00:04:10', 'Anh va em ben nhau', 8, 1, 1),

-- Album 9: chia tay khong dau den the
('mot tinh yeu vo tinh', 'Noi buon cua tinh yeu', 2200, '2019-05-26', '00:03:40', 'Mot tinh yeu da mat', 9, 1, 3),
('chia tay binh yen', 'Cach chia tay khong dau thuong', 2400, '2019-05-27', '00:03:50', 'Chia tay va buoc di', 9, 1, 2),

-- Album 10: trai nghiem cuoc song moi
('cuoc song moi', 'Trai nghiem cuoc song hien dai', 2800, '2017-11-11', '00:03:25', 'Cuoc song mai tuoi xanh', 10, 2, 1),
('nhung ngay moi', 'Hy vong va niem vui', 3000, '2017-11-12', '00:03:15', 'Nhung ngay mai tuoi', 10, 2, 3),

-- Additional songs
('vet dau mua', 'Noi buon sau con mua', 2700, '2022-06-10', '00:04:00', 'Vet dau mua qua nhanh', NULL, 2, 3),
('buoc chan don doc', 'Chuyen ke ve su co don', 2300, '2023-02-20', '00:03:40', 'Buoc chan don doc trong dem', NULL, 4, 2),
('nhip song thanh pho', 'Tieng nhac cua thanh pho', 3400, '2023-09-15', '00:03:45', 'Thanh pho luon soi dong', NULL, 9, 1),
('mot ngay binh yen', 'Tinh yeu trong ngay nhe nhang', 2500, '2021-04-10', '00:03:50', 'Mot ngay cua tinh yeu', NULL, 1, 3),
('dong que lang toi', 'Cau chuyen lang que', 3100, '2022-01-15', '00:03:35', 'Dong que binh yen', NULL, 4, 2),
('duong ve nha', 'Tieng nhac ve nha cua', 3200, '2024-03-05', '00:03:40', 'Duong ve nha tuyet dep', NULL, 9, 1);

-- THE LOAI BAI HAT


INSERT INTO THE_LOAI_BAI_HAT (ID_Bai_hat, The_loai)
VALUES
-- Specific genres for each song
(1, 'nhac que huong'),
(1, 'nhac truyen thong'),
(2, 'nhac que huong'),
(2, 'nhac truyen thong'),

(3, 'nhac tre'),
(3, 'pop'),
(4, 'nhac tre'),
(4, 'pop'),

(5, 'dance'),
(5, 'nhac tre'),
(6, 'dance'),
(6, 'nhac tre'),

(7, 'nhac cach mang'),
(7, 'nhac truyen thong'),
(8, 'nhac truyen thong'),
(8, 'nhac cach mang'),

(9, 'pop'),
(9, 'nhac quoc te'),
(10, 'pop'),
(10, 'nhac quoc te'),

(11, 'nhac tre'),
(11, 'dance'),
(12, 'nhac tre'),
(12, 'dance'),

(13, 'nhac que huong'),
(13, 'nhac truyen thong'),
(14, 'nhac que huong'),
(14, 'nhac truyen thong'),

(15, 'nhac tre'),
(15, 'nhac tinh cam'),
(16, 'nhac tre'),
(16, 'nhac tinh cam'),

(17, 'nhac tinh cam'),
(17, 'pop'),
(18, 'nhac tinh cam'),
(18, 'pop'),

(19, 'nhac tru tinh'),
(19, 'nhac tre'),
(20, 'nhac tru tinh'),
(20, 'nhac tre'),

-- Additional songs
(21, 'nhac tinh cam'),
(21, 'pop'),
(22, 'nhac tru tinh'),
(22, 'nhac que huong'),
(23, 'dance'),
(23, 'nhac tre'),
(24, 'nhac tinh cam'),
(24, 'nhac tre'),
(25, 'nhac que huong'),
(25, 'nhac truyen thong'),
(26, 'nhac tre'),
(26, 'pop');

INSERT INTO NHOM_NHAC_THE_HIEN_BAI_HAT (ID_bai_hat, ID_nhom_nhac)
VALUES
-- Songs performed by "Tre Xanh" (ID_nhom_nhac = 1)
(1, 1),
(2, 1),

-- Songs performed by "Sao Mai" (ID_nhom_nhac = 3)
(5, 3),
(6, 3),

-- Songs performed by "Que Huong" (ID_nhom_nhac = 4)
(13, 4),
(14, 4);

INSERT INTO CA_SI_THE_HIEN_BAI_HAT (ID_bai_hat, ID_ca_si)
VALUES
-- Songs performed by Singer ID 4
(1, 4),
(2, 4),

-- Songs performed by Singer ID 7
(5, 7),
(6, 7),

-- Songs performed by Singer ID 9
(13, 9),
(14, 9),

-- Additional songs performed by Singer ID 5
(17, 5),
(18, 5);

INSERT INTO NHAC_SI_THE_HIEN_BAI_HAT (ID_bai_hat, ID_nhac_si)
VALUES
-- Songs composed by Composer ID 10
(1, 10),
(2, 10),

-- Songs composed by Composer ID 6
(5, 6),
(6, 6),

-- Songs composed by Composer ID 8
(13, 8),
(14, 8),

-- Additional songs composed by Composer ID 8
(17, 8),
(18, 8);

-- Insert into BAI_HAT_THUONG for 17 random songs
INSERT INTO BAI_HAT_THUONG (ID_bai_hat)
VALUES
(1), (2), (3), (4), (6), 
(7), (8), (9), (10), (11), 
(12), (13), (14), (15), (16),
(17), (18), (20);

INSERT INTO BAI_HAT_XIN (ID_bai_hat)
VALUES
(5),
(19);

-- Populate CREDIT_BAI_HAT table
INSERT INTO CREDIT_BAI_HAT (ID_bai_hat, Credit)
VALUES
-- Credits for 'SkyOi'
(1, 'SkyOi'),
(2, 'SkyOi'),
(3, 'SkyOi'),

-- Credits for 'SangSao'
(4, 'SangSao'),
(5, 'SangSao'),
(6, 'SangSao'),

-- Credits for 'MatTroi'
(7, 'MatTroi'),
(8, 'MatTroi'),
(9, 'MatTroi'),

-- Credits for 'DaiDuong'
(10, 'DaiDuong'),
(11, 'DaiDuong'),
(12, 'DaiDuong'),

-- Credits for 'AnhTrang'
(13, 'AnhTrang'),
(14, 'AnhTrang'),

-- Credits for 'BeCon'
(15, 'BeCon'),
(16, 'BeCon'),
(17, 'BeCon'),

-- Credits for 'Star'
(18, 'Star'),
(19, 'Star'),
(20, 'Star'),

-- Credits for 'MiNhon'
(21, 'MiNhon'),
(22, 'MiNhon'),

-- Credits for 'GiacMo'
(23, 'GiacMo'),
(24, 'GiacMo'),

-- Credits for 'ChimXanh'
(25, 'ChimXanh'),
(26, 'ChimXanh'),

-- Credits for 'Tete'
(3, 'Tete'),
(10, 'Tete');



INSERT INTO NGUOI_DUNG (Ten_dang_nhap, Mat_khau)
VALUES
('anhminh', 'Abc@1234'),
('hoanganh', 'Qwe#5678'),
('trungduc', 'Xyz@9012'),
('nguyenvan', 'Pqr$3456'),
('lehoang', 'Lmn%7890'),
('truonghai', 'Jkl&2345'),
('thanhtam', 'Stu@6789'),
('quoctien', 'Vwx#1234'),
('vuthanh', 'Mno$5678'),
('ngocson', 'Bcd&9012'),
('manhhung', 'Efg@3456'),
('ngochieu', 'Hij%7890'),
('phongbao', 'Tuv#2345'),
('quangthanh', 'Wxy@6789'),
('quochung', 'Abc$1234'),
('vinhloc', 'Def&5678'),
('hoangphuc', 'Ghi@9012'),
('tuandung', 'Jkl%3456'),
('anhkiet', 'Mno#7890'),
('vietanh', 'Pqr&2345'),
-- Female
('minhanh', 'Stu@6789'),
('hongngan', 'Vwx#1234'),
('lethuy', 'Abc$5678'),
('trangmai', 'Def&9012'),
('ngoclan', 'Hij@3456'),
('honghoa', 'Klm%7890'),
('nguyenthuy', 'Nop#2345'),
('kimanh', 'Qrs@6789'),
('hoangngoc', 'Tuv$1234'),
('thaoyen', 'Wxy&5678'),
('linhchi', 'Abc@9012'),
('thienthu', 'Def%3456'),
('thuytram', 'Ghi#7890'),
('tuyetngan', 'Jkl&2345'),
('hoaithanh', 'Mno@6789'),
('baoanh', 'Pqr$1234'),
('nganthu', 'Stu#5678'),
('tuongvy', 'Vwx@9012'),
('camly', 'YzA%3456'),
('minhthu', 'Bcd#7890'),
('hoangthu', 'Efg&2345'),
('hannguyen', 'Hij@6789'),
('quynhanh', 'Klm$1234'),
('vantruong', 'Nop#5678'),
('duyhoang', 'Qrs&9012'),
('minhkhang', 'Tuv@3456'),
('thanhson', 'Wxy%7890'),
('quangminh', 'Abc#2345'),
('trantrung', 'Def&6789'),
('dangkhoa', 'Ghi@1234');

-- BAN_BE
-- Group of 4
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(14, 24),
(14, 34),
(14, 44),
(24, 34),
(24, 44),
(34, 44);

-- Group of 3 (1st)
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(5, 15),
(5, 25),
(15, 25);

-- Group of 3 (2nd)
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(6, 16),
(6, 26),
(16, 26);

-- Group of 2 (1st)
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(7, 17);

-- Group of 2 (2nd)
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(8, 18);

-- Group of 2 (3rd)
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(9, 19);

-- Group of 5
INSERT INTO BAN_BE (ID_nguoi_dung_1, ID_nguoi_dung_2)
VALUES
(10, 20),
(10, 30),
(10, 40),
(10, 50),
(20, 30),
(20, 40),
(20, 50),
(30, 40),
(30, 50),
(40, 50);

-- Populate Data for THICH Table
INSERT INTO THICH (ID_Bai_hat, ID_nguoi_dung)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- Populate Data for BINH_LUAN Table
INSERT INTO BINH_LUAN (ID_Bai_hat, ID_nguoi_dung)
VALUES
(1, 1),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(11, 12),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19),
(19, 20),
(20, 1);

-- Populate Data for NOI_DUNG_BINH_LUAN Table
INSERT INTO NOI_DUNG_BINH_LUAN (ID_Bai_hat, ID_nguoi_dung, Noidung)
VALUES
(1, 1, 'Mot bai hat tuyet voi!'),
(2, 3, 'Cau chuyen rat cam dong.'),
(3, 4, 'Tinh yeu va tuoi tre!'),
(4, 5, 'Qua hay, toi rat thich!'),
(5, 6, 'Khong the tin duoc nhac hay den vay.'),
(6, 7, 'Mot buoc nhay hoan hao!'),
(7, 8, 'Hay qua!'),
(8, 9, 'Tinh than cach mang soi dong!'),
(9, 10, 'Cuc ky an tuong voi giai dieu nay.'),
(10, 11, 'Pop nhac rat vui!'),
(11, 12, 'Nhip song nang dong!'),
(12, 13, 'Khong loi nao dien ta noi!'),
(13, 14, 'Mot bai hat rat hay ve lang que.'),
(14, 15, 'Tinh yeu chan thanh!'),
(15, 16, 'Giai dieu nhe nhang.'),
(16, 17, 'Buoc di cua tuoi tre.'),
(17, 18, 'Mot nua tinh yeu.'),
(18, 19, 'Thanh pho soi dong.'),
(19, 20, 'Chia tay binh yen.'),
(20, 1, 'Cuoc song mai tuoi xanh!');

-- Populate Data for RATE Table
INSERT INTO RATE (ID_Bai_hat, ID_nguoi_dung, Diem)
VALUES
(1, 1, 5),
(2, 2, 4),
(3, 3, 3),
(4, 4, 5),
(5, 5, 4),
(6, 6, 3),
(7, 7, 5),
(8, 8, 4),
(9, 9, 5),
(10, 10, 4),
(11, 11, 3),
(12, 12, 4),
(13, 13, 5),
(14, 14, 4),
(15, 15, 3),
(16, 16, 5),
(17, 17, 4),
(18, 18, 5),
(19, 19, 4),
(20, 20, 5);




-- INSERT NHA QUANG CAO
INSERT INTO NHA_QUANG_CAO (Mo_ta, Ten_don_vi_quang_cao)
VALUES
('Cac loai quang cao ve nhac song nuoc','Cong ty quang cao song bien'),
('Cac loai podcast chua lanh','Nha tri lieu tam ly xa hoi'),
('Dong nhac pop moi noi','Dai dien nhom nhac nho');

-- INSERT THE HOP DONG QUANG CAO
INSERT INTO HOP_DONG_QUANG_CAO (Thoi_gian_hieu_luc_hop_dong, Ngay_bat_dau_quang_cao, ID_nha_quang_cao)
VALUES
('2024-02-12', '2024-07-05', 1), -- Expired
('2024-03-17', '2024-07-02', 1), -- Expired
('2024-10-24', '2024-12-30', 1), -- Working
('2024-05-22', '2024-09-30', 2), -- Expired
('2024-03-01', '2024-08-14', 3), -- Expired
('2024-10-11', '2025-01-11', 3); -- Working

-- MODIFY THE HOP DONG LOAI 1 va LOAI 2
INSERT INTO QUANG_CAO_LOAI_1 (ID_quang_cao)
VALUES
(1),
(3),
(5);

INSERT INTO QUANG_CAO_LOAI_2 (ID_quang_cao)
VALUES
(2),
(4),
(6);

-- Insert 4 hot artists into the HOT_ARTIST table
-- Assume IDs 1, 2, 3, and 4 are chosen from the NGHE_SI table
INSERT INTO HOT_ARTIST (ID)
VALUES
(2),
(4),
(6),
(7);

-- Insert data into QUANG_CAO_LOAI_1_CHI_DINH_HOT_ARTIST for 3 hot artists
INSERT INTO QUANG_CAO_LOAI_1_CHI_DINH_HOT_ARTIST (ID_quang_cao_loai_1, ID_hot_artist, Ngay_bat_dau, Ngay_ket_thuc)
VALUES
(1, 2, '2024-01-01', '2024-01-31'), -- 1 for Hot Artist 1
(3, 7, '2024-02-01', '2024-02-28'), -- 3 for Hot Artist 2
(5, 4, '2024-03-01', '2024-03-31'); -- 5 for Hot Artist 3


-- Populate QUANG_CAO_LOAI_2_CHI_DINH_BAI_HAT_THUONG table
INSERT INTO QUANG_CAO_LOAI_2_CHI_DINH_BAI_HAT_THUONG (ID_quang_cao_loai_2, ID_bai_hat_thuong, Ngay_bat_dau, Ngay_ket_thuc)
VALUES
-- Advertisement Campaign 1
(6, 1, '2024-01-01', '2024-01-31'),
(6, 2, '2024-01-01', '2024-01-31'),
(6, 3, '2024-01-01', '2024-01-31'),
(6, 4, '2024-01-01', '2024-01-31'),
(6, 6, '2024-01-01', '2024-01-31'),

-- Advertisement Campaign 2
(2, 7, '2024-02-01', '2024-02-28'),
(2, 8, '2024-02-01', '2024-02-28'),
(2, 9, '2024-02-01', '2024-02-28'),
(2, 10, '2024-02-01', '2024-02-28'),
(2, 11, '2024-02-01', '2024-02-28'),

-- Advertisement Campaign 3
(4, 12, '2024-03-01', '2024-03-31'),
(4, 13, '2024-03-01', '2024-03-31'),
(4, 14, '2024-03-01', '2024-03-31'),
(4, 15, '2024-03-01', '2024-03-31'),
(4, 16, '2024-03-01', '2024-03-31');



-- Add voucher
INSERT INTO VOUCHER (Ngay_bat_dau, Ngay_ket_thuc, Gia_tri)
VALUES
('2023-06-01', '2023-06-30', 29000),
('2024-01-01', '2024-01-31', 25000),
('2024-01-01', '2024-01-31', 12000),
('2024-12-01', '2024-12-31', 50000),
('2024-05-01', '2024-05-31', 41000);

-- Add Thue Bao
INSERT INTO THUE_BAO_PREMIUM (Ngay_bat_dau, Ngay_ket_thuc, Loai_thue_bao, Gia_goc, Thoi_gian_thanh_toan, Thong_tin_thanh_toan, ID_nguoi_dung, ID_voucher)
VALUES
('2024-03-01', '2024-03-31', 'Standard', 150000, '2024-03-02', 'E-Wallet', 11, 2),
('2023-10-01', '2023-10-31', 'Standard', 144000, '2023-10-13', 'E-Wallet', 29, 1),
('2024-06-01', '2024-06-30', 'Standard', 233000, '2024-06-07', 'Bank Transfer', 26, NULL),
('2023-06-01', '2023-06-30', 'Premium', 108000, '2023-06-05', 'Bank Transfer', 21, 3),
('2023-08-01', '2023-08-31', 'Basic', 204000, '2023-08-16', 'E-Wallet', 6, NULL);
-- Populate PLAYLIST table for user IDs 3 and 9
INSERT INTO PLAYLIST (ID, LinkShare, Ten_playlist, Ngay_lap, ID_nguoi_dung)
VALUES
(1, 'link3', 'myplaylist', CURDATE(), 1),
-- Playlist for User ID 3
(1, 'linkshare_playlist1', 'playlist cua tui', '2024-11-01', 3),

-- Playlist for User ID 9
(2, 'linkshare_playlist2', 'nhung bai nhac di ngu playlist', '2024-11-02', 9);

-- Populate BAI_HAT_THUOC_PLAYLIST table
INSERT INTO BAI_HAT_THUOC_PLAYLIST (ID_Bai_hat, ID_Playlist)
VALUES
-- Songs in Playlist 1 (User ID 3)
(1, 1), -- 'duyen que'
(3, 1), -- 'con mua tuoi tre'
(5, 1), -- 'buoc nhay'
(7, 1), -- 'loi song cach mang'
(9, 1), -- 'pop80'

-- Songs in Playlist 2 (User ID 9)
(2, 2), -- 'ho tren dong'
(4, 2), -- 'nhung ngay dep nhat'
(6, 2), -- 'dem nhay'
(8, 2), -- 'anh sang tuong lai'
(10, 2); -- 'bai ca quoc te'