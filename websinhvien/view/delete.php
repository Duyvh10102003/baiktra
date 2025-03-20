<?php
require_once __DIR__ . '/../Model/sinhVien.php';

// Kiểm tra nếu có ID sinh viên được truyền vào
if (!isset($_GET['id'])) {
    die("Không tìm thấy ID sinh viên!");
}

$maSV = $_GET['id'];
$sinhVien = SinhVien::getById($maSV);

// Kiểm tra nếu sinh viên không tồn tại
if (!$sinhVien) {
    die("Không tìm thấy sinh viên!");
}

// Xóa sinh viên khi người dùng xác nhận
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    SinhVien::delete($maSV);
    header("Location: router.php?route=index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include 'layout/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-3 text-danger">XÓA THÔNG TIN</h2>
    <p class="fw-bold">Bạn có chắc chắn muốn xóa sinh viên này?</p>

    <div class="card p-4">
        <div class="row">
            <div class="col-md-3 text-end fw-bold">
                <p>Họ Tên:</p>
                <p>Giới Tính:</p>
                <p>Ngày Sinh:</p>
                <p>Hình:</p>
                <p>Mã Ngành:</p>
            </div>
            <div class="col-md-6">
                <p><?php echo htmlspecialchars($sinhVien['HoTen']); ?></p>
                <p><?php echo htmlspecialchars($sinhVien['GioiTinh']); ?></p>
                <p><?php echo htmlspecialchars($sinhVien['NgaySinh']); ?></p>
                <img src="<?php echo htmlspecialchars($sinhVien['Hinh']); ?>" class="img-thumbnail" alt="Hình sinh viên" width="150">
                <p class="mt-2"><?php echo htmlspecialchars($sinhVien['MaNganh']); ?></p>
            </div>
        </div>
    </div>

    <form method="POST" class="mt-3">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="router.php?route=index" class="btn btn-secondary">Back to List</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
