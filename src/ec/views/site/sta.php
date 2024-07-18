<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var float $platformRevenue */
/** @var yii\data\ArrayDataProvider $dataProvider */

$this->title = 'Thống kê';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section-container">


    <div class="section-container">
        <h4>Doanh thu của sàn: <?= number_format($platformRevenue, 0, ',', '.') ?> VND</h4>
    </div>

    <div class="section-container">
        <h4>Phí hoàn lại cho các shop:</h4>

        <div class="grid-view-container">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'shop_name',
                        'label' => 'Shop',
                    ],
                    [
                        'attribute' => 'refund_fee',
                        'label' => 'Phí hoàn lại',
                        'value' => function ($data) {
                            return number_format($data['refund_fee'], 0, ',', '.') . ' VND';
                        },
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Trạng thái',
                        'value' => function ($data) {
                            return $data['status'] == 3 ? 'Đã thanh toán' : 'Chưa thanh toán';
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
<style>
    .section-container {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
    }

    .section-container h1,
    .section-container h2,
    .section-container h3 {
        margin-top: 0;
    }

    .grid-view-container {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .grid-view table {
        width: 100%;
        border-collapse: collapse;
    }

    .grid-view th, .grid-view td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .grid-view th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>
