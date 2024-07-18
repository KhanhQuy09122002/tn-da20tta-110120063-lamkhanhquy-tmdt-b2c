<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShopOrders $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shop-orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->status == 1): ?>
            <?= Html::a('Duyệt đơn hàng', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
          
         
            [
                'attribute' => 'total',
                'value' => function ($model) {
                    return number_format($model->total, 0, ',', '.') . ' VND';
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 1:
                            return 'Chưa duyệt';
                        case 2:
                            return 'Đã hủy';
                        case 3:
                            return 'Đã duyệt';
                        default:
                            return 'Không xác định';
                    }
                },
            ],
        ],
      
    ]) ?>

    <h4 class="text-center">Chi tiết đơn hàng</h4>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getShopOrderDetails(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'product_name',
            'quantity',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 0, ',', '.') . ' VND';
                },
            ],
            // Add more columns as needed
        ],
    ]) ?>

</div>
