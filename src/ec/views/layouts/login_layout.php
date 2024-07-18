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
    <?php $this->head() ?>
   <style>
       
/* Reset some default styles */
body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
}

.site-login {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-container {
    width: 100%;
    max-width: 400px;
    padding: 15px;
}

.login-card {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.login-header {
    background-color: #ff5722;
    padding: 15px;
    text-align: center;
}

.login-title {
    color: #fff;
    margin: 0;
}

.login-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: none;
}

.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-input:focus {
    border-color: #ff5722;
    box-shadow: 0 0 0 2px rgba(255, 87, 34, 0.2);
}

.form-error {
    color: #ff5722;
    margin-top: 5px;
    font-size: 0.875em;
}

.checkbox {
    display: flex;
    align-items: center;
}

.checkbox label {
    margin-left: 5px;
}

.btn-login {
    background-color: #ff5722;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-login:hover {
    background-color: #e64a19;
}

.link {
    color: #ff5722;
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}

.text-center {
    text-align: center;
}


   

.login-form {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #eaeaea;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-form h4 {
        margin-bottom: 20px;
        color: #333;
    }
    .login-form .form-group {
        margin-bottom: 15px;
    }
    .login-form .form-control {
        height: 45px;
        border-radius: 5px;
    }
    .login-form .btn-primary {
        background-color: #ff5722;
        border-color: #ff5722;
        width: 100%;
        height: 45px;
        border-radius: 5px;
    }
    .login-form .btn-primary:hover {
        background-color: #e64a19;
        border-color: #e64a19;
    }
    .login-form .register-link {
        margin-top: 20px;
    }
    </style>



<?php $this->beginBody() ?>







<main id="main" class="flex-shrink-0 mt-3 mb-0" role="main">
    <div class="container-fuild">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>







<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
