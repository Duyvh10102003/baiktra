<?php
require_once 'controller/SinhVienController.php';

// Lấy route từ URL
$route = isset($_GET['route']) ? $_GET['route'] : 'index';

// Tạo đối tượng Controller
$controller = new SinhVienController();

// Điều hướng route
switch ($route) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'details':
        $controller->details();
        break;
    default:
        echo "404 Not Found";
        break;
}
?>
