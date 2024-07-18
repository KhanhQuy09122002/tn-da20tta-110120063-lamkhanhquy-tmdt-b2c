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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==" crossorigin="anonymous" />

    <?php $this->head() ?>
   <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            width: 400px;
        }
        .container img {
            margin-bottom: 20px;
        }
        .container h5 {
            margin-bottom: 10px;
            color: #333;
        }
        .container p {
            margin-bottom: 20px;
            color: #666;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #17a2b8;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #138496;
        }

        /* main */
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
}

.nav-link {
    color: #333;
}

.nav-link:hover {
    color: #007bff;
}

.nav-link.active {
    color: #007bff;
}

.main-content {
    padding: 20px;
}

  /* Thêm CSS cho navbar */
  .custom-navbar {
            background-color: #ffffff !important; /* Màu trắng tinh */
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
   
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
