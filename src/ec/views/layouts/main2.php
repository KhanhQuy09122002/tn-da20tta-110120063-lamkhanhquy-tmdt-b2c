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
            color: #333;
            color: white; /* White text color */
        }

        .nav-link:hover {
            color: #007bff;
        }

        .nav-link.active {
            background-color: #495057; /* Slightly lighter background on hover */
            color: white;
        }

        .main-content {
            padding: 20px;
        }

        .shop-view {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
<?php $this->beginBody() ?>

 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="/images/logo.png" alt="Shoplite Logo" class="brand-logo"> Shoplite
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
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
            'label' => '' . Yii::$app->user->identity->username . ' | Hồ sơ',
            'items' => [
                ['label' => 'Cập nhật thông tin ', 'url' => ['/site/updateuser'], 'linkOptions' => ['data-method' => 'post']],
                ['label' => 'Đăng xuất', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    ?>
</nav>

<!-- Sidebar and Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/site/home">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#shop-management-menu" aria-expanded="false" aria-controls="shop-management-menu">
        <i class="fas fa-cube"></i> <span><?= Yii::t('app', 'Quản lý Shop') ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="collapse" id="shop-management-menu">
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop/index', 'status' => 1]) ?>"><i class="fa fa-circle-o"></i>+ Shop chưa duyệt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop/index', 'status' => 2]) ?>"><i class="fa fa-circle-o"></i>+ Shop đã duyệt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop/index', 'status' => 3]) ?>"><i class="fa fa-circle-o"></i>+ Shop tạm dừng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/shop/index', 'status' => 4]) ?>"><i class="fa fa-circle-o"></i>+ Shop đã hủy</a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#order-management-menu" aria-expanded="false" aria-controls="order-management-menu">
        <i class="fas fa-receipt"></i> <span><?= Yii::t('app', 'Đơn hàng') ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="collapse" id="order-management-menu">
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/orders/index', 'status' => 3]) ?>"><i class="fa fa-circle-o"></i>+ Đơn đã duyệt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/orders/index', 'status' => 1]) ?>"><i class="fa fa-circle-o"></i>+ Đơn chưa duyệt</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/orders/index', 'status' => 2]) ?>"><i class="fa fa-circle-o"></i>+ Đơn đã hủy</a>
        </li>
    </ul>
</li>

<li class="nav-item">
                        <a class="nav-link" href="/categories/index">
                            <i class="fas fa-archive"></i>
                           Quản lý ngành hàng
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="/site/sta">
                            <i class="fas fa-chart-bar"></i>
                            Thống kê
                        </a>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
