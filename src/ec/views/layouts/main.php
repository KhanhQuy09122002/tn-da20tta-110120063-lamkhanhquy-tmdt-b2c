<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;

use yii\helpers\Url;
$cart = isset($this->params['cart']) ? $this->params['cart'] : [];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==" crossorigin="anonymous" />
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

<df-messenger
  intent="WELCOME"
  chat-title="b2c_chat"
  agent-id="39e27d61-70f5-4f6d-aefe-59853310149b"
  language-code="en"
></df-messenger>
    <?php $this->head() ?>
   <style>
    .text-db {
    color: #dc3545; /* Màu đỏ nhạt */
}   
#main {
    /* hoặc margin-top: 0; */
    padding-top: 45px;
}

   /* Reset CSS */
   * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            background-color: #ee4d2d;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        nav ul {
            list-style-type: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffdbac;
        }

        .search-bar {
            display: flex;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 8px 20px;
            background-color: #fff;
            color: #ee4d2d;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #ffdbac;
        }

     

        .featured-products, .promotions {
            margin-bottom: 40px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        footer ul {
            list-style-type: none;
        }

        footer ul li {
            display: inline;
            margin-right: 10px;
        }

        footer ul li a {
            text-decoration: none;
            color: #fff;
        }

        .social-media {
            margin-top: 20px;
        }

        .social-media a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #fff;
            color: #333;
            font-size: 24px;
            line-height: 40px;
            text-align: center;
            margin-right: 10px;
            border-radius: 50%;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .social-media a:hover {
            background-color: #ee4d2d;
            color: #fff;
        }



/* Custom CSS for Navbar */
.custom-navbar {
    padding: 10px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.custom-navbar .navbar-brand {
    display: flex;
    align-items: center;
}

.custom-navbar .brand-logo {
    height: 40px;
    margin-right: 10px;
}

.search-form {
    flex-grow: 1;
    max-width: 500px;
    margin: 0 20px;
}

.search-input {
    border-radius: 0;
    flex-grow: 1;
}

.search-button {
    border-radius: 0;
}

.navbar-nav .nav-item .nav-link {
    color: #333;
    padding: 10px 15px;
    font-weight: 500;
}

.navbar-nav .nav-item .nav-link:hover {
    color: #007bff;
}

@media (max-width: 767px) {
    .search-form {
        width: 100%;
        margin: 10px 0;
    }

    .navbar-nav .nav-item {
        text-align: center;
    }

    .navbar-nav {
        margin-top: 10px;
       
    }
}





.slide-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            border-radius: 8px;
        }
        .slide-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }
        .slide img {
            width: 100%;
            border-radius: 8px;
        }
        .nav-btn {
            position: absolute;
            top: 50%;
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            transform: translateY(-50%);
            z-index: 10;
        }
        .prev-btn {
            left: 0;
            border-radius: 0 8px 8px 0;
        }
        .next-btn {
            right: 0;
            border-radius: 8px 0 0 8px;
        }
        .nav-dots {
            text-align: center;
            position: absolute;
            bottom: 20px;
            width: 100%;
            z-index: 10;
        }
        .nav-dots button {
            border: none;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 12px;
            height: 12px;
            margin: 5px;
            cursor: pointer;
        }
        .nav-dots button.active {
            background-color: white;
        }
    
        
/* Product */
.products {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.product-item {
    border: 1px solid #e0e0e0;
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff;
   
}

.product-item img {
    width: 100%;
    height: 200px;
    margin-bottom: 10px;
    object-fit: cover;
    position: relative;
    overflow: hidden;
}
.product-image {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease; /* Áp dụng transition cho thuộc tính transform */
}

.product-item:hover .product-image {
    transform: scale(1.1); /* Hiệu ứng phóng to khi di chuột vào */
}

.product-info h2 {
    font-size: 18px;
    margin-bottom: 5px;
}

.product-info p {
    margin-bottom: 5px;
    font-size: 14px;
}

.product-detail {
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 8px;
    background-color: #f9f9f9;
    margin: 20px 0;
}

.product-detail h1 {
    font-size: 20px;
    margin-bottom: 8px;
}

.product-detail img {
    max-width: 50%;
    height: 400px;
    margin-bottom: 10px;
}

.product-detail p {
    margin-bottom: 8px;
    font-size: 14px;
}
.custom-red {
        color: red;
    }

/* Test */
body {
            font-family: 'Roboto', Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
       
       
        .product-info p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .product-info p b {
            font-weight: 700;
        }
        .product-info .price {
            color: #ff5722;
            font-size: 20px;
            font-weight: 700;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .btn-primary {
            background-color: #ff5722;
            color: #fff;
        }
        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }
        .breadcrumb {
        padding-left: 60px; /* Điều chỉnh giá trị này để thay đổi lề trái */
    }
    /*Update User */
    .site-updateuser {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .site-updateuser h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
        color: #555;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }
    .form-group .btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        background-color: #ff5722;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }
    .form-group .btn:hover {
        background-color: #e64a19;
    }
    .reset-password-link {
        text-align: center;
        display: block;
        margin-bottom: 20px;
    }
    .reset-password-link a {
        color: #ff5722;
        text-decoration: none;
        font-weight: 600;
    }
    .reset-password-link a:hover {
        text-decoration: underline;
    }
 
    .custom-navbar {
            background-color: white !important;
        }


        .btn-search {
            background-color: orange;
            color: white; /* Màu chữ trắng để nổi bật trên nền cam */
            border-color: orange; /* Đảm bảo viền nút cũng màu cam */
        }
        .btn-search:hover {
            background-color: darkorange; /* Màu cam đậm hơn khi hover */
            border-color: darkorange;
        }

   
        .product-wrapper {
    flex: 0 0 20%; /* 5 sản phẩm mỗi hàng, mỗi sản phẩm chiếm 20% */
    max-width: 20%;
    box-sizing: border-box;
    padding: 10px; /* Khoảng cách giữa các sản phẩm */
}

df-messenger {
    position: fixed;
    bottom: 0px; /* Điều chỉnh vị trí theo ý muốn */
    right: 20px; /* Điều chỉnh vị trí theo ý muốn */
    z-index: 10000; /* Đảm bảo nó hiển thị trên cùng */
}

df-messenger .chat-wrapper {
    margin-top: 10px; /* Điều chỉnh để tránh bị che khuất bởi header */
}

    </style>

</head>

<?php $this->beginBody() ?>


<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light static-top fixed-top custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                <img src="/images/logo.png" alt="Shoplite Logo" class="brand-logo">
                Sellify
            </a>

     <!-- Nút tìm kiếm -->
<form class="d-flex mx-auto" action="<?= yii\helpers\Url::to(['/site/search']) ?>" method="get">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm" name="search">
        <button class="btn btn-search" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/site/index">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="showCategories" href="/site/voucher">
                        <i class="fas fa-list"></i> Ưu đãi
                    </a>
                        </li>


                        
                        <li class="nav-item">
    <a class="nav-link" href="/site/view-cart">
        <i class="fas fa-shopping-cart"></i> 
        <?php
        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        // Hiển thị số lượng sản phẩm
        if ($totalQuantity > 0) {
            echo Html::tag('span', $totalQuantity, ['class' => 'badge badge-pill badge-danger']);
        }
        ?>
       Giỏ hàng
    </a>
</li>

                   
                    
                  

                        <li class="nav-item">
    <?php if (Yii::$app->user->isGuest): ?>
        <!-- Điều hướng đến trang đăng nhập nếu người dùng chưa đăng nhập -->
        <?= Html::a('<i class="fas fa-building"></i> Kênh người bán', ['site/login'], ['class' => 'nav-link']) ?>
    <?php else: ?>
        <!-- Hiển thị liên kết Kênh người bán nếu người dùng đã đăng nhập -->
        <a class="nav-link" href="<?= Url::to(['/site/doanhnghiep']) ?>">
            <i class="fas fa-building"></i> Kênh người bán
        </a>
    <?php endif; ?>
</li>

                </ul>

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
                            ['label' => 'Đơn hàng của tôi ', 'url' => ['/orders/updateod'], 'linkOptions' => ['data-method' => 'post']],
                            ['label' => 'Đăng xuất', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],
                    ];
                }

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav ms-auto'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
        </div>
    </nav>
</header>




<main id="main" class="flex-shrink-0 mt-3 mb-0" role="main">
    <div class="container-fuild">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer id="footer" class="mt-auto py-3 bg-white">
    <div class="container">
        <div class="row text-dark justify-content-end">
            <div class="col-md-3 text-center">
                <p><b> HỖ TRỢ KHÁCH HÀNG </b></p>
                <p>Hotline: 1900-6035</p>
                <p>Các câu hỏi thường gặp</p>
                <p>Hướng dẫn đặt hàng</p>
                <p>Phương thức vận chuyển</p>
            </div>
            <div class="col-md-3 text-center">
                <p><b> VỀ SHOPLITE </b></p>
                <p>Giới thiệu về ShopLite</p>
                <p>Điều khoản sử dụng</p>
            </div>
            <div class="col-md-3 text-center">
                <p><b>HỢP TÁC VÀ LIÊN KẾT</b></p>
                <p>Quy chế hoạt động động của sàn</p>
                <p>Bán hàng cùng ShopLite</p>
            </div>
            <div class="col-md-3 text-center">
                <p><b>KẾT NỐI VỚI CHÚNG TÔI</b></p>
                    <p>
                         <a href="https://www.facebook.com">
                            <img src="/images/facebook.png" alt="Facebook Logo" class="brand-logo">
                        </a>
        
                    </p>
                <p>
                        <a href="https://www.tiktok.com/">
                            <img src="/images/tiktok.png" alt="Zalo Logo" class="brand-logo">
                        </a>
       
                </p>
                <p>
                        <a href="https://www.tiktok.com">
                            <img src="/images/youtube.png" alt="Tiktok Logo" class="brand-logo">
                        </a>
        
                </p>
            </div>

        </div>
    </div>
</footer>






<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
