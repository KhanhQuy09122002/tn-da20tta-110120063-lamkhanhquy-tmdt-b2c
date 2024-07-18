<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="panel panel-default">
       
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?= Html::img($model->product_image, ['alt' => 'Product Image', 'class' => 'img-responsive', 'style' => 'max-width: 100%; height: auto;']) ?>
                </div>
                <div class="col-md-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
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
                            'detail:ntext',
                            'describe:ntext',
                            'product_quantity',
                            [
                                'label' => 'Danh mục sản phẩm',
                                'value' => $model->getCategoryName(), // Sử dụng hàm để lấy tên danh mục từ cate_id
                            ],
                            [
                                'label' => 'Shop',
                                'value' => $model->getShopName(), // Sử dụng hàm để lấy tên shop từ shop_id
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    switch ($model->status) {
                                        case 1:
                                            return 'Bình thường';
                                        case 2:
                                            return 'Vô hiệu hóa';
                                        case 3:
                                            return 'Không tồn tại';
                                        default:
                                            return 'Không xác định';
                                    }
                                },
                                'format' => 'html',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <p>
        <?= Html::a('Cập nhật', ['update', 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa bỏ', ['delete', 'product_id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
