<?php

use app\models\ShopOrders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShopOrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shop Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-orders-index">

    <h4><?= Html::encode($this->title) ?></h4>

 

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shop_id',
            'order_id',
            'payment',
            'total',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ShopOrders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
