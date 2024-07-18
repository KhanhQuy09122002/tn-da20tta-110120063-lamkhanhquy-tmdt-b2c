<?php

use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;

$userId = Yii::$app->user->identity->id;
$shop = \app\models\Shop::findOne(['user_id' => $userId]);
$shopId = $shop->id;

$searchModel->shop_id = $shopId;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Thêm sản phẩm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'product_code',
            'product_name',
            [
                'attribute' => 'product_price',
                'value' => function ($model) {
                    return number_format($model->product_price, 0, ',', '.') . ' VNĐ';
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'product_image',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->product_image, ['alt' => 'Product Image', 'style' => 'width:100px;']);
                },
            ],
            //'detail:ntext',
            //'describe:ntext',
            //'product_quantity',
            //'cate_id',
            //'shop_id',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Products $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id]);
                 }
            ],
        ],
    ]); ?>


</div>
