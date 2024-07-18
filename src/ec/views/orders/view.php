<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\ShopOrders;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => $model->user->fullname,
            ],
            'order_date',
            [
                'attribute' => 'total',
                'value' => function ($model) {
                    return number_format($model->total, 0, ',', '.') . ' VND';
                },
            ],
            [
                'attribute' => 'payment_method',
                'value' => $model->payment_method == 1 ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản',
            ],
            'status',
        ],
    ]) ?>

    <h4 class="text-center">Chi tiết đơn hàng</h4>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getOrderDetails()->with('product'),
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_id',
                'label' => 'Tên sản phẩm',
                'value' => function ($model) {
                    return $model->product->product_name;
                },
            ],
            'quantity',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return number_format($model->price, 0, ',', '.') . ' VND';
                },
            ],
        ],
    ]) ?>

    <h4 class="text-center">Tình trạng kiểm duyệt đơn hàng</h4>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => ShopOrders::find()->where(['order_id' => $model->id]),
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          
            [
                'attribute' => 'shop_id',
                'label' => 'Tên shop',
                'value' => function ($model) {
                    return $model->shop->shop_name;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 3 ? 'Đã duyệt' : 'Chưa duyệt'; // Hiển thị 'Đã duyệt' nếu status = 3, ngược lại là 'Chưa duyệt'
                },
            ],
        ],
    ]) ?>

</div>
