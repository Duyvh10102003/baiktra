<?php
if (!isset($sinhVien)) {
    die("Không tìm thấy sinh viên!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include 'layout/header.php'; ?>

<!-- Form chỉnh sửa sinh viên -->
<div class="container mt-4">
    <h2 class="text-center">Chỉnh Sửa Thông Tin Sinh Viên</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="router.php?route=edit&id=<?= htmlspecialchars($sinhVien['MaSV']) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MaSV" value="<?= htmlspecialchars($sinhVien['MaSV']) ?>">

                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="hoTen" class="form-control" value="<?= htmlspecialchars($sinhVien['HoTen']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="gioiTinh" class="form-control">
                        <option value="Nam" <?= ($sinhVien['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= ($sinhVien['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="ngaySinh" class="form-control" value="<?= date('Y-m-d', strtotime($sinhVien['NgaySinh'])) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình Ảnh</label>
                    <div class="d-flex align-items-center">
                        <input type="file" name="hinh" class="form-control me-2">
                    </div>
                    <?php if (!empty($sinhVien['Hinh'])): ?>
                        <img src="<?= htmlspecialchars($sinhVien['Hinh']) ?>" class="img-fluid mt-2" width="150">
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành</label>
                    <input type="text" name="maNganh" class="form-control" value="<?= htmlspecialchars($sinhVien['MaNganh']) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="router.php?route=index" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
