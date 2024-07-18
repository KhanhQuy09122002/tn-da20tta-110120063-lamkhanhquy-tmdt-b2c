<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ShopOrders $model */

$this->title = 'Duyệt đơn hàng: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Duyệt đơn hàng';
?>
<div class="shop-orders-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('form', [
        'model' => $model,
    ]) ?>

</div>
