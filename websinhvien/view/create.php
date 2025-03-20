<?php
require_once 'Model/database.php';

$conn = Database::connect();

// Xử lý khi người dùng nhấn nút Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];
    $Hinh = '';

    // Kiểm tra và lưu ảnh lên server
    if (!empty($_FILES['Hinh']['name'])) {
        $target_dir = "uploads/";
        $Hinh = $target_dir . basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $Hinh);
    }

    // Chuẩn bị câu lệnh SQL để tránh lỗi SQL Injection
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MaSV', $MaSV);
    $stmt->bindParam(':HoTen', $HoTen);
    $stmt->bindParam(':GioiTinh', $GioiTinh);
    $stmt->bindParam(':NgaySinh', $NgaySinh);
    $stmt->bindParam(':Hinh', $Hinh);
    $stmt->bindParam(':MaNganh', $MaNganh);

    if ($stmt->execute()) {
        header("Location: router.php?route=index"); // Chuyển về danh sách sinh viên
        exit();
    } else {
        $error = "Lỗi: Không thể thêm sinh viên.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<?php include 'layout/header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center">THÊM SINH VIÊN</h2>

        <?php if (isset($error)) : ?>
<script>
    alert("<?php echo $error; ?>");
</script>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Mã Sinh Viên</label>
        <input type="text" name="MaSV" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Họ Tên</label>
        <input type="text" name="hoTen" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giới Tính</label>
        <select name="gioiTinh" class="form-select">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Ngày Sinh</label>
        <input type="date" name="ngaySinh" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Hình Ảnh</label>
        <input type="file" name="hinh" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Mã Ngành</label>
        <input type="text" name="maNganh" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="router.php?route=index" class="btn btn-secondary">Quay lại</a>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
