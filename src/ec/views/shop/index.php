<?php

use app\models\Shop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ShopSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// Xử lý title dựa trên tham số status
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 1:
            $this->title = 'Shop chưa duyệt';
            break;
        case 2:
            $this->title = 'Shop đã duyệt';
            break;
        case 3:
            $this->title = 'Shop tạm dừng';
            break;
        case 4:
            $this->title = 'Shop đã hủy';
            break;
        default:
            $this->title = 'Shops';
            break;
    }
} else {
    $this->title = 'Shops';
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'shop_name',
            [
                'attribute' => 'logo_shop',
                'format' => 'html',
                'label' => 'Logo shop',
                'value' => function ($model) {
                    return Html::img($model->logo_shop, ['width' => '100px']);
                },
            ],
            'des_shop:ntext',
            'address_shop',
            // Các cột khác nếu có

            // Chỉ định template mới cho cột hành động mà không chứa biểu tượng "Delete"
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update}', // Chỉ hiển thị biểu tượng "View" và "Update"
                'urlCreator' => function ($action, Shop $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
