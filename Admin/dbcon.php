<?php
class dbcon
{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "cheo";
    private $db;

    function __construct()
    {
        $this->db = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        $this->db->set_charset("utf8");
    }

    function TotalComments() {
        $sql = "SELECT COUNT(*) AS total_comments FROM binhluan ";
        $result = $this->db->query($sql);
        
        if (!$result) {
            die("Query failed: " . $this->db->error);
        }
    
        $row = $result->fetch_assoc(); 
        $totalcomments = $row['total_comments']; 
    
        return $totalcomments;
    }
    

    
    function TotalRevenue() {
        $sql = "SELECT SUM(Tong) AS TotalRevenue FROM HoaDon WHERE TrangThai != 'Đã hủy'";
        $result = $this->db->query($sql);
    
        if (!$result) {
            die("Query failed: " . $this->db->error);
        }
    
        $row = $result->fetch_assoc(); 
        $TotalRevenue = $row['TotalRevenue']; 
    
        return $TotalRevenue;
    }
    

    function TotalOrdersX() {
        $sql_td = "SELECT COUNT(*) AS total_orders FROM hoadon WHERE TrangThai != 'Đã hủy' AND DATE(NgayDat) = CURDATE()";
        $result_td = $this->db->query($sql_td);
        
        if (!$result_td) {
            die("Query failed: " . $this->db->error);
        }
        
        $row_td = $result_td->fetch_assoc(); 
        $TotalOrders_td= $row_td['total_orders']; 
        
        
        $sql_yd = "SELECT COUNT(*) AS total_orders FROM hoadon WHERE TrangThai != 'Đã hủy' AND DATE(NgayDat) = CURDATE() - INTERVAL 1 DAY";
        $result_yd = $this->db->query($sql_yd);
        
        if (!$result_yd) {
            die("Query failed: " . $this->db->error);
        }
        
        $row_yd= $result_yd->fetch_assoc(); 
        $TotalOrders_yd = $row_yd['total_orders']; 
        
        // Tính số lượng đơn đặt hàng tăng hơn so với hôm qua
        $kq_sosanh = $TotalOrders_td - $TotalOrders_yd;
        
        if ($kq_sosanh > 0) {
            return $kq_sosanh;
        } else {
            return 0;
        }
    }
    

    function LichSuHoaDon() {
        $sql = "SELECT IdHD, IdKH, Tong, DATE_FORMAT(NgayDat, '%Y-%m-%d %H:%i') AS NgayDat, TrangThai, PhuongThucThanhToan, TinhTrang_ThanhToan FROM hoadon WHERE TrangThai = 'Đã hủy' OR TrangThai='Đã giao'";
        $kq = $this->db->query($sql);
        return $kq;
    }
    

    function LienHe() {
        $sql = "SELECT *, DATE_FORMAT(ThoiGian, '%H:%i %d-%m-%Y') AS ThoiGian FROM LienHe ORDER BY ThoiGian DESC";
        $result = $this->db->query($sql);
        
        if (!$result) {
            die("Query failed: " . $this->db->error);
        }
    
        return $result;
    }
    
  
    function SuaTrangThai( $TrangThai,$IdHD)
    {
       
        $sql = "UPDATE HoaDon 
                SET  TrangThai = '{$TrangThai}'
                WHERE IdHD = '{$IdHD}'";

        $kq = $this->db->query($sql);
     if (!$kq) {
        die("Query failed: " . $this->db->error);
                 }   
             return $kq;
    }
    
    function leaderboard()
    {
        $sql = "SELECT SanPham.*, SUM(ChiTietHoaDon.SoLuong) AS TongSoLuongBan 
                FROM SanPham 
                JOIN ChiTietHoaDon ON SanPham.IdSP = ChiTietHoaDon.IdSP 
                GROUP BY SanPham.IdSP 
                ORDER BY TongSoLuongBan DESC 
                LIMIT 8";
        $kq = $this->db->query($sql);
        if (!$kq) {
            die("Query failed: " . $this->db->error);
        }
        return $kq;
    }

    
    function TotalOrders() {
        $sql = "SELECT COUNT(*) AS total_orders FROM hoadon WHERE TrangThai != 'Đã hủy' AND TrangThai != 'Đã giao'";
        $result = $this->db->query($sql);
        
        if (!$result) {
            die("Query failed: " . $this->db->error);
        }
    
        $row = $result->fetch_assoc(); 
        $totalOrders = $row['total_orders']; 
    
        return $totalOrders;
    }
    

    
   

    

    function TotalUsers() {
        $sql = "SELECT COUNT(*) AS total_users FROM khachhang WHERE taikhoan = 'user'";
        $result = $this->db->query($sql);
        
        if (!$result) {
            die("Query failed: " . $this->db->error);
        }
    
        $row = $result->fetch_assoc(); 
        $totalUsers = $row['total_users']; 
    
     
    
        return $totalUsers;
    }
    
    // Xử lý đăng nhập
 function Drink($vitri, $sp)
{
    $sql = "SELECT SanPham.IdSP, SanPham.TenSP, Loai_SanPham.IdLoai, SanPham.SoLuong, SanPham.HinhAnh,SanPham.TinhTrang ,SanPham.GiaTheoSize,SanPham.PhanTramSPKM,
    JSON_EXTRACT(`GiaTheoSize`, '$.S') AS gia_S,
    JSON_EXTRACT(`GiaTheoSize`, '$.M') AS gia_M,
    JSON_EXTRACT(`GiaTheoSize`, '$.L') AS gia_L   
    FROM SanPham
    INNER JOIN Loai_SanPham ON SanPham.IdLoai = Loai_SanPham.IdLoai
    WHERE Loai_SanPham.IdLoai != 'T' 
    ORDER BY SanPham.IdSP LIMIT $vitri, $sp";

    $kq = $this->db->query($sql);

    if (!$kq) {
        die("Query failed: " . $this->db->error);
    }

    return $kq;
}




function ThemSanPham($idSP, $TenSP, $idLoai, $gia_S, $gia_M, $gia_L, $HinhAnh, $TinhTrang, $PhanTramSPKM)
{
 
    $checkQuery = "SELECT * FROM sanpham WHERE LOWER(TenSP) = LOWER('$TenSP')";
    $result = $this->db->query($checkQuery);

    if ($result->num_rows > 0) {
        return false;
    } else {
      
        if (substr($idSP, 0, 2) !== substr($idLoai, 0, 2)) {
            echo "Mã loại sản phẩm không phù hợp với mã sản phẩm.";
            return;
        } else {
            $sql = "INSERT INTO sanpham (idSP, TenSP, idLoai, HinhAnh, TinhTrang, GiaTheoSize, PhanTramSPKM) 
                    VALUES ('$idSP', '$TenSP', '$idLoai', '$HinhAnh', '$TinhTrang', '{\"S\":{$gia_S}, \"M\":{$gia_M}, \"L\":{$gia_L}}','$PhanTramSPKM')";

            $kq = $this->db->query($sql);

            if (!$kq) {
                die("Query failed: " . $this->db->error);
            }

            return $kq;
        }
    }
}



function MonThem($idSP, $TenSP, $idLoai, $SoLuong, $GiaTheoSize, $TinhTrang)
{
    $checkQuery = "SELECT * FROM sanpham WHERE LOWER(TenSP) = LOWER('$TenSP')";
    $result = $this->db->query($checkQuery);

    if ($result->num_rows > 0) {
        return false; 
    } else {
        if (substr($idSP, 0, 1) === 'T' && substr($idLoai, 0, 1) === 'T') {
            $sql = "INSERT INTO sanpham (idSP, TenSP, idLoai, SoLuong, GiaTheoSize, TinhTrang ) 
                    VALUES ('$idSP', '$TenSP', '$idLoai', '$SoLuong' , '$GiaTheoSize','$TinhTrang')";

            $kq = $this->db->query($sql);

            if (!$kq) {
                die("Query failed: " . $this->db->error);
            }

            return $kq;
        } else {
            echo "Sản phẩm trùng mã loại hoặc không đúng mã.";
            return false;
        }
    }
}


function MonThemXoa($IdSP)
{
    $sql = "DELETE FROM SanPham WHERE IdSP='{$IdSP}'";
    $kq = $this->db->query($sql);
    return $kq;
}

    
    // Phương thức xóa sản phẩm
    function XoaSanPham($IdSP)
    {
        $sql = "DELETE FROM SanPham WHERE IdSP='{$IdSP}'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function XoaLichSu($IdHD)
    {
        // Xóa tất cả các chi tiết hóa đơn liên quan
        $sqlChiTiet = "DELETE FROM ChiTietHoaDon WHERE IdHD='{$IdHD}'";
        $kqChiTiet = $this->db->query($sqlChiTiet);
    
        // Xóa hóa đơn chính
        $sqlHoaDon = "DELETE FROM HoaDon WHERE IdHD='{$IdHD}'";
        $kqHoaDon = $this->db->query($sqlHoaDon);
    
        // Kiểm tra kết quả xóa
        if ($kqChiTiet && $kqHoaDon) {
            return true; // Xóa thành công
        } else {
            return false; // Xóa không thành công
        }
    }
    

    // Phương thức xóa mã sản phẩm
    function XoaMaSanPham($IdLoai)
    {
        $sql = "DELETE FROM loai_sanpham WHERE IdLoai='{$IdLoai}'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function SuaSanPham_id($IdSP)
    {
        $sql = "SELECT *,
    /*canthiet*/JSON_EXTRACT(GiaTheoSize, '$.S') AS gia_S,
               JSON_EXTRACT(GiaTheoSize, '$.M') AS gia_M,
               JSON_EXTRACT(GiaTheoSize, '$.L') AS gia_L
               FROM SanPham WHERE IdSP='{$IdSP}'"; // chua co loai anh ra ne
        $kq = $this->db->query($sql);
        return $kq;
    }
    

function SuaSanPham($IdSP, $TenSP, $IdLoai, $gia_S, $gia_M, $gia_L, $TinhTrang, $HinhAnh,$PhanTramSPKM)
{
    // Assuming $this->db is your database connection object
    $sql = "UPDATE SanPham 
            SET TenSP = '{$TenSP}', 
                IdLoai = '{$IdLoai}', 
                GiaTheoSize = '{\"S\":{$gia_S}, \"M\":{$gia_M}, \"L\":{$gia_L}}', 
                TinhTrang = '{$TinhTrang}', 
                PhanTramSPKM = '{$PhanTramSPKM}', 
                HinhAnh = '{$HinhAnh}' 
            WHERE IdSP = '{$IdSP}'";

    $kq = $this->db->query($sql);
    return $kq;
}


    function DSSanPham()
    {
        $sql = "SELECT  IdSP,IdLoai,TenSP,SoLuong,GiaTheoSize,HinhAnh,PhanTramSPKM,
          JSON_EXTRACT(`GiaTheoSize`, '$.S') AS `gia_S`,
        JSON_EXTRACT(`GiaTheoSize`, '$.M') AS `gia_M`,
        JSON_EXTRACT(`GiaTheoSize`, '$.L') AS `gia_L`  FROM SanPham ";
        $kq = $this->db->query($sql);
        return $kq;
    }


    function LoaiSanPham($vitri, $sp)
    {
        $sql = "SELECT *
        FROM loai_sanpham
        ORDER BY loai_sanpham.idLoai LIMIT $vitri, $sp";

        $kq = $this->db->query($sql);
        return $kq;
    }
    



function Search($tim_kiem)
{
    $tim_kiem = strtolower($tim_kiem); // Chuyển đổi tim_kiem thành chữ thường

    $sql = "SELECT SanPham.IdSP, SanPham.TenSP, Loai_SanPham.IdLoai, SanPham.SoLuong, SanPham.HinhAnh,SanPham.TinhTrang ,SanPham.GiaTheoSize,
        JSON_EXTRACT(`GiaTheoSize`, '$.S') AS gia_S,
        JSON_EXTRACT(`GiaTheoSize`, '$.M') AS gia_M,
        JSON_EXTRACT(`GiaTheoSize`, '$.L') AS gia_L   
        FROM SanPham
        INNER JOIN loai_sanpham ON sanpham.idLoai = loai_sanpham.idLoai 
        WHERE LOWER(TenSP) LIKE '%$tim_kiem%'
        AND loai_sanpham.IdLoai != 'T'"; // Thêm điều kiện loại sản phẩm không phải 'T'
    
    $kq = $this->db->query($sql);
    if ($kq->num_rows > 0) {
        return $kq;
    } else {
        return null;
    }
}

    function ThemMaSanPham($IdLoai, $TenLoai,)
    {
        $sql = "INSERT INTO loai_sanpham (IdLoai,TenLoai) VALUES ('{$IdLoai}', '{$TenLoai}')";
        $kq = $this->db->query($sql);

        if (!$kq) {
            die("Query failed: " . $this->db->error);
        }

        return $kq;
    }

    function SuaMaSanPham_id($IdLoai)
    {
        $sql = "SELECT IdLoai,TenLoai FROM loai_sanpham where IdLoai='{$IdLoai}'";  // chua co loai anh ra ne
        $kq = $this->db->query($sql);
        return $kq;
    }

    function SuaMaSanPham($IdLoai, $TenLoai)
    {
        $sql = "UPDATE loai_sanpham SET IdLoai='{$IdLoai}', TenLoai='{$TenLoai}' WHERE IdLoai='{$IdLoai}'";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function ChiTietHoaDon($IdHD)
    {
        $sql = "SELECT IdCTHD,IdSP,IdHD,SoLuong,DonGia, DATE_FORMAT(NgayDat, '%H:%i %d-%m-%Y') AS NgayDat,Size,LuongDuong,LuongDa,Them FROM chitiethoadon WHERE IdHD='{$IdHD}' ";
        $kq = $this->db->query($sql);
        return $kq;
    }

    function HoaDon() {
        $sql = "SELECT IdHD, IdKH, Tong, DATE_FORMAT(NgayDat, '%Y-%m-%d %H:%i') AS NgayDat, TrangThai, PhuongThucThanhToan, TinhTrang_ThanhToan FROM hoadon WHERE TrangThai != 'Đã hủy' AND TrangThai != 'Đã giao'";
        $kq = $this->db->query($sql);
        return $kq;
    }
    
    

    function More($vitri, $sp)
    {
        $sql = "SELECT SanPham.IdSP, SanPham.TenSP, Loai_SanPham.IdLoai, SanPham.SoLuong,SanPham.GiaTheoSize,SanPham.TinhTrang 
                FROM SanPham 
                INNER JOIN Loai_SanPham ON SanPham.IdLoai = Loai_SanPham.IdLoai
                WHERE SanPham.IdLoai = 'T'
                ORDER BY SanPham.IdSP
                LIMIT $vitri, $sp";
        
        $kq = $this->db->query($sql);
        
        if (!$kq) {
            die("Query failed: " . $this->db->error);
        }
        
        return $kq;
    }
    
    function SuaMonThem_id($IdSP)
    {
        $sql = "SELECT *
             FROM SanPham 
             WHERE IdSP='{$IdSP}'"; // chua co loai anh ra ne
        $kq = $this->db->query($sql);
        return $kq;
    }

    function SuaMonThem($IdSP, $TenSP, $IdLoai, $SoLuong, $GiaTheoSize, $TinhTrang){
        $sql = "UPDATE SanPham 
                SET TenSP = '{$TenSP}', 
                    IdLoai = '{$IdLoai}', 
                    SoLuong = '{$SoLuong}', 
                    GiaTheoSize = '{$GiaTheoSize}', 
                    TinhTrang = '{$TinhTrang}' 
                WHERE IdSP = '{$IdSP}'";

        $kq = $this->db->query($sql);
        return $kq;
    }
    
}
