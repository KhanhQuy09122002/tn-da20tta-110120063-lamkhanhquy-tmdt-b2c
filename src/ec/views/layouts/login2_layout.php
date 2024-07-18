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
       .site-login {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
}

.login-container {
    display: flex;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.login-image {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 20px;
}

.login-image img {
    max-width: 100%;
    height: auto;
}

.login-card {
    flex: 1;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.login-header {
    text-align: center;
    margin-bottom: 20px;
}

.login-title {
    font-size: 24px;
    font-weight: bold;
}

.login-body {
    width: 100%;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    margin-bottom: 5px;
    font-weight: bold;
}

.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.form-error {
    color: #e3342f;
    font-size: 0.875em;
}

.btn-login {
    width: 100%;
    padding: 10px;
    background-color: #f26b3c;
    border: none;
    border-radius: 4px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.btn-login:hover {
    background-color: #e65a2f;
}

.link {
    color: #007bff;
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}

.checkbox {
    display: flex;
    align-items: center;
} 
 
          /* */
          .shop-register-form {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.shop-register-form .form-group {
    margin-bottom: 15px;
}

.shop-register-form .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.shop-register-form .form-control:focus {
    border-color: #ff5722;
    box-shadow: 0 0 5px rgba(255, 87, 34, 0.2);
}

.shop-register-form .btn-primary {
    background-color: #ff5722;
    border-color: #ff5722;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.shop-register-form .btn-primary:hover {
    background-color: #e64a19;
    border-color: #e64a19;
}

.shop-register-form .text-center h4 {
    margin-bottom: 20px;
    font-weight: bold;
    color: #ff5722;
}

.shop-register-form .register-link a {
    color: #ff5722;
    font-weight: bold;
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
