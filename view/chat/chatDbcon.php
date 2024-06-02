<?php
class chatdbcon
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

    function search($searchTerm)
    {
        $timkiem = "SELECT * FROM KhachHang WHERE (TenKH LIKE '%$searchTerm%')";
        $kq = $this->db->query($timkiem);
        return $kq;
    }

    function hienthitinnhancuoicung($idnguoinhan, $idnguoigui)
    {
        $ht = "SELECT *,DATE_FORMAT(ThoiGianGui, '%H:%i ngày %d-%m-%Y') AS NgayGio FROM TinNhan WHERE (IdNguoiNhan = '$idnguoinhan'
        OR IdNguoiGui = '$idnguoinhan') AND (IdNguoiGui ='$idnguoigui'
        OR IdNguoiNhan = '$idnguoigui') ORDER BY IdTN DESC LIMIT 1";
        $kq = $this->db->query($ht);
        return $kq;
    }

    function hienthikhachhang()
    {
        $ht = "SELECT KhachHang.*, MAX(TinNhan.ThoiGianGui) AS ThoiGianGui
        FROM KhachHang
        LEFT JOIN TinNhan ON KhachHang.IdKH = TinNhan.idnguoigui OR KhachHang.IdKH = TinNhan.idnguoinhan
        GROUP BY KhachHang.IdKH
        ORDER BY MAX(TinNhan.ThoiGianGui) DESC";
        $kq = $this->db->query($ht);
        return $kq;
    }

    function themtinnhan($noidung, $idnguoigui)
    {
        $them = "INSERT INTO TinNhan (NoiDung,IdNguoiGui,IdNguoiNhan,ThoiGianGui) VALUES ('$noidung','$idnguoigui','admin',NOW())";
        $result = $this->db->query($them);
        return $result;
    }

    function themtinnhan2($noidung, $idnguoinhan)
    {
        $them = "INSERT INTO TinNhan (NoiDung,IdNguoiGui,IdNguoiNhan,ThoiGianGui) VALUES ('$noidung','admin','$idnguoinhan',NOW())";
        $result = $this->db->query($them);
        return $result;
    }

    function laytinnhan($idnguoigui)
    {
        $lay = "SELECT * FROM TinNhan LEFT JOIN KhachHang ON KhachHang.IdKH = TinNhan.IdNguoiGui
        WHERE (IdNguoiGui = '$idnguoigui' AND IdNguoiNhan = 'admin')
        OR (IdNguoiGui = 'admin' AND IdNguoiNhan = '$idnguoigui') ORDER BY IdTN";
        $result = $this->db->query($lay);
        return $result;
    }

    function laythongtin($id)
    {
        $lay = "SELECT * FROM KhachHang WHERE IdKH = '$id'";
        $result = $this->db->query($lay);
        return $result;
    }
}
