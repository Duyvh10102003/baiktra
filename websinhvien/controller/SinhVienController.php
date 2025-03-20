<?php
require_once __DIR__ . '/../Model/sinhVien.php';

class SinhVienController {
    // Hiển thị danh sách sinh viên
    public function index() {
        $sinhViens = SinhVien::getAll();
        include __DIR__ . '/../view/index.php';
    }

    // Tạo sinh viên mới
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoTen = isset($_POST['hoTen']) ? $_POST['hoTen'] : null;
            $gioiTinh = isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : null;
            $ngaySinh = isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : null;
            $hinh = isset($_POST['hinh']) ? $_POST['hinh'] : null;
            $maNganh = isset($_POST['maNganh']) ? $_POST['maNganh'] : null;
    
            if ($hoTen && $gioiTinh && $ngaySinh && $maNganh) {
                SinhVien::add($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
                header("Location: router.php?route=index");
                exit;
            } else {
                $error = "Vui lòng điền đầy đủ thông tin!";
            }
        }
        include __DIR__ . '/../view/create.php';
    }

    // Chỉnh sửa thông tin sinh viên
    public function edit() {
        if (!isset($_GET['id'])) {
            die("Không tìm thấy ID sinh viên!");
        }

        $maSV = $_GET['id'];
        $sinhVien = SinhVien::getById($maSV);

        if (!$sinhVien) {
            die("Không tìm thấy sinh viên!");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hoTen = $_POST['hoTen'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $maNganh = $_POST['maNganh'];

            // Xử lý hình ảnh mới
            $hinh = $sinhVien['Hinh'];
            if (!empty($_FILES['hinh']['name'])) {
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($_FILES["hinh"]["name"]);
                move_uploaded_file($_FILES["hinh"]["tmp_name"], "../" . $targetFile);
                $hinh = $targetFile;
            }

            // Cập nhật thông tin sinh viên
            SinhVien::update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
            header("Location: router.php?route=index");
            exit;
        }

        include __DIR__ . '/../view/edit.php';
    }

    // Xóa sinh viên
    public function delete() {
        if (!isset($_GET['id'])) {
            die("Không tìm thấy ID sinh viên!");
        }

        $maSV = $_GET['id'];
        $sinhVien = SinhVien::getById($maSV);

        if (!$sinhVien) {
            die("Không tìm thấy sinh viên!");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            SinhVien::delete($maSV);
            header("Location: router.php?route=index");
            exit;
        }

        include __DIR__ . '/../view/delete.php';
    }

    // Xem chi tiết sinh viên
    public function details() {
        if (!isset($_GET['id'])) {
            die("Không tìm thấy ID sinh viên!");
        }

        $maSV = $_GET['id'];
        $sinhVien = SinhVien::getById($maSV);

        if (!$sinhVien) {
            die("Không tìm thấy sinh viên!");
        }

        include __DIR__ . '/../view/details.php';
    }
}
?>
