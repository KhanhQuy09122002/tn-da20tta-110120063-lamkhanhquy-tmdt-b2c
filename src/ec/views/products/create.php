<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
/** @var yii\web\View $this */
/** @var app\models\Products $model */
JqueryAsset::register($this);
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Thêm sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$css = <<<CSS
/* custom.css */

.products-form {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.products-form .form-group {
    margin-bottom: 15px;
}

.products-form .form-control {
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
}

.products-form .btn {
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
}

.products-form .btn-success {
    background-color: #ff5722;
    border-color: #ff5722;
}

.products-form .btn-success:hover {
    background-color: #e64a19;
    border-color: #e64a19;
}

.products-form label {
    font-weight: bold;
    color: #333;
}

.products-form .panel-heading {
    background-color: #ff5722;
    color: #fff;
    border-color: #ff5722;
}

.products-form .panel-title {
    font-weight: bold;
}

.products-form .img-responsive {
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
    padding: 5px;
    background-color: #fff;
    border-radius: 5px;
}

CSS;
$this->registerCss($css);
?>
