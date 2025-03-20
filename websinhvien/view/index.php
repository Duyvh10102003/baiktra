<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'layout/header.php'; ?>

    <!-- Container -->
    <div class="container mt-4">
        <h2 class="mb-3">TRANG SINH VIÊN</h2>
        <a href="router.php?route=create" class="btn btn-primary mb-3">Thêm sinh viên</a>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>MaSV</th>
                        <th>HoTen</th>
                        <th>GioiTinh</th>
                        <th>NgaySinh</th>
                        <th>Hinh</th>
                        <th>MaNganh</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhViens as $sv): ?>
                        <tr>
                            <td><?= htmlspecialchars($sv['MaSV']) ?></td>
                            <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                            <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                            <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($sv['Hinh']) ?>" class="img-thumbnail" width="100">
                            </td>
                            <td><?= htmlspecialchars($sv['MaNganh']) ?></td>
                            <td>
                                <a href="router.php?route=edit&id=<?= $sv['MaSV'] ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="router.php?route=details&id=<?= $sv['MaSV'] ?>" class="btn btn-sm btn-primary">Details</a>
                                <a href="router.php?route=delete&id=<?= $sv['MaSV'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
