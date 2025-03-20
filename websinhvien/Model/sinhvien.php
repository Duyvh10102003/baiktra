<?php
require_once 'database.php';

class SinhVien {
    public static function getAll() {
        $conn = Database::connect();
        $stmt = $conn->query("SELECT * FROM SinhVien");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($maSV) {
    $conn = Database::connect();
    $sql = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MaSV', $maSV);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public static function add($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO SinhVien (HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (:hoTen, :gioiTinh, :ngaySinh, :hinh, :maNganh)");
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
        $stmt->execute();
    }

    public static function update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $conn = Database::connect();
        $stmt = $conn->prepare("UPDATE SinhVien SET HoTen = :hoTen, GioiTinh = :gioiTinh, NgaySinh = :ngaySinh, Hinh = :hinh, MaNganh = :maNganh WHERE MaSV = :maSV");
        $stmt->bindParam(':maSV', $maSV);
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':gioiTinh', $gioiTinh);
        $stmt->bindParam(':ngaySinh', $ngaySinh);
        $stmt->bindParam(':hinh', $hinh);
        $stmt->bindParam(':maNganh', $maNganh);
        $stmt->execute();
    }

    public static function delete($maSV) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM SinhVien WHERE MaSV = :maSV");
        $stmt->bindParam(':maSV', $maSV);
        $stmt->execute();
    }
}
?>
