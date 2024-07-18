<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ShopOrders $model */

$this->title = 'Create Shop Orders';
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
