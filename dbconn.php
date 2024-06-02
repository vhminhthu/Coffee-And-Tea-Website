<?php
class dbconn
{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "cheo";
    private $db;


    function __construct()
    {
        $this->db = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        $this->db->set_charset("utf8");
    }

    function XuLyDangKy($name, $phone, $email, $password)
    {
        $dangky = "INSERT INTO KhachHang(`TenKH`, `SDT`, `Email`, `MatKhau`) 
        VALUES ('$name','$phone','$email','$password')";
        $kqDangKy = $this->db->query($dangky);
        return $kqDangKy;
    }

    function kiemtradangky($e)
    {
        $dangky = "SELECT * FROM KhachHang WHERE Email='$e'";
        $kqDangKy = $this->db->query($dangky);
        return $kqDangKy;
    }

    function Xulydangky_sdt($phone)
    {
        $dangky_sdt = "UPDATE KhachHang SET SDT = LPAD(SDT, 10, '0')";
        $kqdangky_sdt = $this->db->query($dangky_sdt);
        return $kqdangky_sdt;
    }

    function Xulydangnhap($e, $p)
    {
        $dangnhap = "SELECT * FROM KhachHang WHERE Email='$e' AND MatKhau='$p' ";
        $kqDangNhap = $this->db->query($dangnhap);
        return $kqDangNhap;
    }

    function hienthitatcasanpham()
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`  FROM SanPham WHERE IdLoai != 'T' AND TinhTrang='Đang bán'  ";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthitatcasanphamtheotrang($vitri, $sp)
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`  FROM SanPham WHERE IdLoai != 'T' AND TinhTrang='Đang bán' ORDER BY SoLuong DESC LIMIT $vitri, $sp";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanpham($id)
    {
        $sql = "SELECT *,
        JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`,
        JSON_EXTRACT(`GiaTheoSize`, '$.M') AS `gia_M`,
        JSON_EXTRACT(`GiaTheoSize`, '$.L') AS `gia_L` 
        FROM SanPham 
        WHERE IdSP='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthitatcaloai()
    {
        $sql = "SELECT * FROM Loai_SanPham WHERE IdLoai != 'T'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamtheotheloai($idloai)
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S` FROM SanPham WHERE IdLoai = '$idloai'  AND TinhTrang='Đang bán'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamtheotheloaitheotrang($idloai, $vitri, $sp)
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S` FROM SanPham WHERE IdLoai = '$idloai'  AND TinhTrang='Đang bán' ORDER BY SoLuong DESC LIMIT $vitri, $sp";
        $kq = $this->db->query($sql);
        return $kq;
    }
    function hienthitentheloai($id)
    {
        $sql = "SELECT SanPham.*,Loai_SanPham.TenLoai as ten_the_loai FROM SanPham JOIN Loai_SanPham ON SanPham.IdLoai= Loai_SanPham.IdLoai WHERE IdSP='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisptentheloai($id)
    {
        $sql = "SELECT * FROM Loai_SanPham WHERE IdLoai='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamlienquan($idTL, $id)
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S` FROM SanPham WHERE IdLoai='$idTL' AND IdSP<>'$id'  AND TinhTrang='Đang bán'  ORDER BY RAND()  LIMIT 4";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthimonthemsanpham()
    {
        $sql = "SELECT *,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S` FROM SanPham WHERE IdLoai='T'  AND TinhTrang='Đang bán'";
        $kq = $this->db->query($sql);
        return $kq;
    }


    function hienthisanphamtheososao($sosao)
    {
        $sql = "SELECT SanPham.*,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        INNER JOIN BinhLuan ON SanPham.IdSP = BinhLuan.IdSP
        WHERE BinhLuan.SoSao = '$sosao' AND TinhTrang='Đang bán'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamtheososaotheotrang($sosao, $vitri, $sp)
    {
        $sql = "SELECT SanPham.*,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        INNER JOIN BinhLuan ON SanPham.IdSP = BinhLuan.IdSP
        WHERE BinhLuan.SoSao = '$sosao' AND TinhTrang='Đang bán' ORDER BY SanPham.SoLuong DESC LIMIT $vitri, $sp";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamtheogiatien($tien1, $tien2)
    {
        $sql = "SELECT *, JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        WHERE (JSON_EXTRACT(`GiaTheoSize`, '$.S') BETWEEN '$tien1' AND '$tien2') AND TinhTrang='Đang bán'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthisanphamtheogiatientheotrang($tien1, $tien2, $vitri, $sp)
    {
        $sql = "SELECT *, ROUND(((JSON_EXTRACT(`GiaTheoSize`, '$.S')) - ((JSON_EXTRACT(`GiaTheoSize`, '$.S') * (PhanTramSPKM / 100))))) AS `gia_S_giam`,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        WHERE (ROUND(((JSON_EXTRACT(`GiaTheoSize`, '$.S')) - ((JSON_EXTRACT(`GiaTheoSize`, '$.S') * (PhanTramSPKM / 100))))) BETWEEN '$tien1' AND '$tien2' ) AND TinhTrang='Đang bán' ORDER BY SoLuong DESC LIMIT $vitri, $sp";
        $kq = $this->db->query($sql);
        return $kq;
    }


    function laythongtinkhachhang($id)
    {
        $sql = "SELECT * FROM KhachHang WHERE IdKH ='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function suathongtinkhachhangkhigiaohang($id, $tenkh, $sdt, $diachi)
    {
        $sql = "UPDATE KhachHang 
                SET TenKH = '$tenkh', SDT = '$sdt', DiaChi = '$diachi' 
                WHERE IdKH ='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function suathongtinkhachhangkhigiaohangdaydu($id, $email, $tenkh, $sdt, $diachi)
    {
        $sql = "UPDATE KhachHang 
                SET TenKH = '$tenkh', SDT = '$sdt', Email = '$email', DiaChi = '$diachi' 
                WHERE IdKH ='$id'";
        $kq = $this->db->query($sql);
        return $kq;
    }


    function themThongtinHoaDon($tong, $phuongthucthanhtoan, $idkh)
    {
        $sql = "INSERT INTO HoaDon(Tong,NgayDat,PhuongThucThanhToan,IdKH) 
        VALUES ('$tong',NOW(),'$phuongthucthanhtoan','$idkh')";
        $kq = $this->db->query($sql);
        if ($kq) {
            $idcuoi = $this->db->insert_id;
        } else {
            echo "Lỗi: " . $this->db->error;
        }
        return $idcuoi;
    }

    function themChitietHoaDon($idhd, $idsp, $size, $soluong, $dongia, $luongda, $luongduong, $them)
    {
        $sql = "INSERT INTO ChiTietHoaDon(IdHD,IdSP,Size,SoLuong,DonGia,NgayDat,LuongDa,LuongDuong,Them) 
        VALUES ('$idhd','$idsp','$size','$soluong','$dongia',NOW(),'$luongda','$luongduong','$them')";
        $kq = $this->db->query($sql);
        return $kq;
    }


    function Search($tim_kiem)
    {

        $sql = "SELECT *, JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        INNER JOIN Loai_SanPham ON SanPham.IdLoai = Loai_SanPham.IdLoai WHERE TenSP LIKE '%$tim_kiem%'AND Loai_SanPham.IdLoai != 'T'";
        $kq = $this->db->query($sql);
        if ($kq->num_rows > 0) {
            return $kq;
        } else {
            return null;
        }
    }

    function Searchtheotrang($tim_kiem, $vitri, $sp)
    {

        $sql = "SELECT *, JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM SanPham
        INNER JOIN Loai_SanPham ON SanPham.IdLoai = Loai_SanPham.IdLoai WHERE TenSP LIKE '%$tim_kiem%'AND Loai_SanPham.IdLoai != 'T' AND SanPham.TinhTrang='Đang bán' ORDER BY SoLuong DESC LIMIT $vitri, $sp";
        $kq = $this->db->query($sql);
        if ($kq->num_rows > 0) {
            return $kq;
        } else {
            return null;
        }
    }
    function toploai()
    {
        $sql = "SELECT Loai_SanPham.*, SUM(SanPham.SoLuong) AS TongSoLuotXem
        FROM Loai_SanPham
        JOIN SanPham ON Loai_SanPham.IdLoai = SanPham.IdLoai
        WHERE Loai_SanPham.IdLoai != 'T'
        GROUP BY Loai_SanPham.TenLoai
        ORDER BY TongSoLuotXem DESC
        LIMIT 6";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function topsp()
    {
        $sql = "SELECT SanPham.*, SUM(ChiTietHoaDon.SoLuong) AS TongSoLuongBan FROM SanPham JOIN ChiTietHoaDon ON SanPham.IdSP = ChiTietHoaDon.IdSP GROUP BY SanPham.IdSP ORDER BY TongSoLuongBan DESC LIMIT 5";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthiyeuthich($idkh)
    {
        $yeuthich = "SELECT YeuThich.*, sanpham.* ,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM YeuThich 
        INNER JOIN sanpham ON YeuThich.IdSP = sanpham.IdSP
        WHERE YeuThich.IdKH = '$idkh' ORDER BY YeuThich.ThoiGian DESC";
        $kqhienthi = $this->db->query($yeuthich);
        return $kqhienthi;
    }

    function hienthitopyeuthich($idkh)
    {
        $yeuthich = "SELECT YeuThich.*, sanpham.* ,JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`
        FROM YeuThich 
        INNER JOIN sanpham ON YeuThich.IdSP = sanpham.IdSP
        WHERE YeuThich.IdKH = '$idkh' 
        ORDER BY YeuThich.ThoiGian DESC
        LIMIT 5";
        $kqhienthi = $this->db->query($yeuthich);
        return $kqhienthi;
    }
    function hienthitongyeuthich($idkh)
    {
        $yeuthich = "SELECT COUNT(IdSP) AS TongSoLuongThich FROM YeuThich WHERE IdKH = '$idkh' GROUP BY IdKH";
        $kqhienthi = $this->db->query($yeuthich);
        return $kqhienthi;
    }

    function kiemtrayeuthich($idsp, $idkh)
    {
        $kiemtra = "SELECT * FROM YeuThich WHERE IdSP = '$idsp' AND IdKH = '$idkh'";
        $result = $this->db->query($kiemtra);
        return $result;
    }

    function themyeuthich($idsp, $idkh)
    {
        $kiemtra = "SELECT * FROM YeuThich WHERE IdSP = '$idsp' AND IdKH = '$idkh'";
        $result = $this->db->query($kiemtra);
        if ($result->num_rows == 0) {
            $themmoi = "INSERT INTO YeuThich (ThoiGian, IdSP, IdKH) VALUES (NOW(), '$idsp', '$idkh')";
            $kqthemmoi = $this->db->query($themmoi);
            if ($kqthemmoi) {
                echo json_encode(array("status" => true, "liked" => true));
            } else {
                echo json_encode(array("status" => false));
            }
        } else {
            $xoa = "DELETE FROM YeuThich WHERE IdSP = '$idsp' AND IdKH = '$idkh'";
            $kqxoa = $this->db->query($xoa);
            if ($kqxoa) {
                echo json_encode(array("status" => true, "liked" => false));
            } else {
                echo json_encode(array("status" => false));
            }
        }
    }

    function hienthihoadon($idkh)
    {
        $ht = "SELECT * ,DATE_FORMAT(NgayDat, '%H:%i ngày %d-%m-%Y') AS NgayGio FROM HoaDon WHERE IdKH = '$idkh' ORDER BY NgayDat DESC";
        $result = $this->db->query($ht);
        return $result;
    }

    function hienthichitiethoadon($id)
    {
        $ht = "SELECT ChiTietHoaDon.*, SanPham.*, HoaDon.*,ChiTietHoaDon.soluong AS soluongmua, DATE_FORMAT(ChiTietHoaDon.NgayDat, '%H:%i ngày %d-%m-%Y') AS NgayGio 
        FROM ChiTietHoaDon 
        JOIN SanPham ON ChiTietHoaDon.IdSP = SanPham.IdSP 
        JOIN HoaDon ON ChiTietHoaDon.IdHD = HoaDon.IdHD 
        WHERE ChiTietHoaDon.IdHD = '$id'";
        $result = $this->db->query($ht);
        return $result;
    }

    function huyhoadon($idhd)
    {
        $sql = "UPDATE HoaDon SET TrangThai = 'Đã Hủy' WHERE IdHD = '$idhd'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function themlienhe($ten, $email, $noidung)
    {
        $sql = "INSERT INTO LienHe(Ten,Email,NoiDung,ThoiGian) 
        VALUES ('$ten','$email','$noidung',NOW())";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function laysoluongnguoixem($id)
    {
        $ht = "SELECT SoLuong FROM SanPham WHERE IdSP = '$id'";
        $result = $this->db->query($ht);
        return $result;
    }

    function capnhatsoluongnguoixem($id, $sl)
    {
        $ht = "UPDATE SanPham SET SoLuong = '$sl' WHERE IdSP = '$id'";
        $result = $this->db->query($ht);
        return $result;
    }

    function thembinhluan($mota, $sosao, $idsp, $idkh)
    {
        $sql = "INSERT INTO BinhLuan(MoTa,SoSao,ThoiGianBinhLuan,IdSP,IdKH) 
        VALUES ('$mota','$sosao',NOW(),'$idsp','$idkh')";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function hienthibinhluan($idsp)
    {
        $ht = "SELECT BinhLuan.*, KhachHang.TenKH,DATE_FORMAT(ThoiGianBinhLuan, '%H:%i ngày %d-%m-%Y') AS ThoiGianBinhLuan
        FROM BinhLuan 
        INNER JOIN KhachHang ON BinhLuan.IdKH = KhachHang.IdKH 
        WHERE BinhLuan.IdSP = '$idsp'";
        $result = $this->db->query($ht);
        return $result;
    }

    function hienthitopbinhluan()
    {
        $ht = "SELECT BinhLuan.*,AVG(BinhLuan.SoSao) AS TBSao,SanPham.*,SanPham.IdSP AS IdSPtop
        FROM BinhLuan
        INNER JOIN SanPham ON BinhLuan.IdSP = SanPham.IdSP 
        GROUP BY BinhLuan.IdSP
        LIMIT 3";
        $result = $this->db->query($ht);
        return $result;
    }


    function kiemtradebinhluan($idsp,$idkh)
    {
        $ht = "SELECT BinhLuan.*
        FROM BinhLuan 
        WHERE IdSP = '$idsp' AND IdKH ='$idkh'";
        $result = $this->db->query($ht);
        return $result;
    }

    function kiemtradamuaspchua($idsp,$idkh)
    {
        $ht = "SELECT ChiTietHoaDon.*,HoaDon.*
        FROM ChiTietHoaDon
        INNER JOIN HoaDon ON HoaDon.IdHD = ChiTietHoaDon.IdHD
        WHERE HoaDon.IdKH ='$idkh' AND ChiTietHoaDon.IdSP='$idsp'";
        $result = $this->db->query($ht);
        return $result;
    }

}
