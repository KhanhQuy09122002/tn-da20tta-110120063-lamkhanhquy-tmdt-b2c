<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */

$this->title = 'Duyệt Shop: ' . $model->shop_name;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shop_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật thông tin Shop';
?>
<div class="shop-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('form2', [
        'model' => $model,
    ]) ?>

</div>
