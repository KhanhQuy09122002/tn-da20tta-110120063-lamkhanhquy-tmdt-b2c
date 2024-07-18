<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <?php $this->head() ?>
    <style>
        /* Custom styles for admin template */
        body {
            font-family: Arial, sans-serif;
        }

        .navbar-brand .brand-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .sidebar {
            min-height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            background: #343a40; /* Dark background for sidebar */
        }

        .nav-link {
            color: #ffffff; /* White text color */
        }

        .nav-link:hover {
            color: #007bff;
        }

        .nav-link.active,
        .nav-link.selected {
            background-color: #007bff; /* Blue background on click */
            color: white;
        }

        .treeview-menu {
            display: none;
            list-style: none;
            padding-left: 15px;
            text-decoration: none;
        }

        .treeview a {
            position: relative;
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
        }

        .treeview-menu a {
            padding-left: 30px;
        }

        .treeview a .fa-angle-left {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .treeview-menu a:hover {
            color: #007bff;
        }

        .main-content {
            padding: 20px;
        }

        .shop-view {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .shop-view h4 {
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th {
            width: 25%;
            background-color: #f8f9fa;
        }

        .table td {
            width: 75%;
        }

        footer h5, footer p, footer li, footer a {
            color: #ffffff; /* Màu trắng cho văn bản */
        }

        footer p {
            color: #ffffff; /* Màu trắng cho văn bản trong footer */
        }
    </style>
</head>
<?php $this->beginBody() ?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="/images/logo.png" alt="Shoplite Logo" class="brand-logo"> Sellifly
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <?php
        $menuItems = [];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = [
                'label' => '<i class="fas fa-sign-in-alt"></i> Đăng nhập',
                'url' => ['/site/login'],
                'encode' => false, // Đảm bảo rằng HTML trong 'label' sẽ không bị mã hóa
            ];
        } else {
            $menuItems[] = [
                'label' => Yii::$app->user->identity->username . ' | Hồ sơ',
                'items' => [
                    ['label' => 'Cập nhật thông tin', 'url' => ['/site/updateuser'], 'linkOptions' => ['data-method' => 'post']],
                    ['label' => 'Đăng xuất', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        ?>
    </div>
</nav>

<!-- Sidebar and Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/site/bussi">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop/vshop">
                            <i class="fas fa-store"></i>
                          Thông tin Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products/index">
                            <i class="fas fa-box"></i>
                            Quản lý sản phẩm
                        </a>
                    </li>
                   
      
       
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#shop-management-menu" aria-expanded="false" aria-controls="shop-management-menu">
        <i class="fas fa-receipt"></i> <span><?= Yii::t('app', 'Đơn hàng') ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="collapse" id="shop-management-menu">
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop-orders/index', 'status' => 1]) ?>"><i class="fa fa-circle-o"></i>+ Đơn chưa duyệt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop-orders/index', 'status' => 2]) ?>"><i class="fa fa-circle-o"></i>+ Đơn đã hủy</a>
        </li>
     
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop-orders/index', 'status' => 3]) ?>"><i class="fa fa-circle-o"></i>+ Đơn đã duyệt</a>
        </li>
    </ul>
</li>
<li class="nav-item">
                        <a class="nav-link" href="/site/stabs">
                            <i class="fas fa-chart-bar"></i>
                            Thống kê
                        </a>
                    </li>
                    
                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-cog"></i>
                        <span><?= Yii::t('app', 'Cài đặt Shop') ?></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        
                        <ul class="treeview-menu">
                        <li id="toggleShopStatus">
                            <a href="#" onclick="confirmDeleteShop1()">
                             <i class="fa fa-circle-o"></i>+ Tạm dừng Shop
                             </a>
                        </li>

                            <li><a href="#"onclick="confirmDeleteShop()"><i class="fa fa-circle-o"></i>+ Hủy Shop</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main id="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" role="main">
            <div class="container-fluid mt-3 mb-0">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>
</div>

<footer id="footer" class="mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row mt-3">
            <div class="col text-center">
                <p class="text-white">&copy; <?= date('Y') ?> Sellify. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function() {
        // Xử lý toggle cho treeview menu
        $('.treeview a').on('click', function(e) {
            e.preventDefault();
            $(this).next('.treeview-menu').slideToggle();
            $(this).find('.fa-angle-left').toggleClass('fa-angle-down');
        });

        // Lấy trạng thái từ sessionStorage và thiết lập lớp 'selected' cho menu được chọn
        var selectedMenu = sessionStorage.getItem('selectedMenu');
        if (selectedMenu) {
            $('.nav-link[href="' + selectedMenu + '"]').addClass('selected');
        }

        // Xử lý sự kiện nhấn vào nav-link
        $('.nav-link').on('click', function() {
            // Bỏ qua menu Đăng nhập
            if ($(this).attr('href') === '/site/login') {
                return;
            }

            // Xóa lớp 'selected' khỏi tất cả các nav-link
            $('.nav-link').removeClass('selected');

            // Thêm lớp 'selected' vào nav-link hiện tại
            $(this).addClass('selected');

            // Lưu trạng thái của nav-link được chọn vào sessionStorage
            sessionStorage.setItem('selectedMenu', $(this).attr('href'));
        });
    });


    function confirmDeleteShop() {
    if (confirm("Bạn chắc chắn muốn hủy shop?")) {
       
        window.location.href = '/shop/delete1'; 
    }

    
}

function confirmDeleteShop1() {
    if (confirm("Bạn chắc chắc muốn tạm dừng shop? ")) {
        // Thay đổi nội dung của thẻ <li> thành "Mở lại Shop"
        var listItem = document.querySelector('#toggleShopStatus');
        listItem.innerHTML = '<a href="#" onclick="confirmReopenShop(); return false;"><i class="fa fa-circle-o"></i>+ Mở lại Shop</a>';

        // Đoạn code bổ sung: có thể thực hiện các thay đổi khác sau khi xác nhận
        // Ví dụ: gửi yêu cầu AJAX đến server để thực hiện hành động

        // Sau khi thực hiện xong, chuyển hướng hoặc thực hiện các thao tác khác nếu cần
         window.location.href = '/shop/delay'; // Ví dụ chuyển hướng sau khi thực hiện
    }
}

</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
