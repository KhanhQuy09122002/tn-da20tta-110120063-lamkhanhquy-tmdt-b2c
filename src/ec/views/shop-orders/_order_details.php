<?php
use yii\helpers\Html;
?>
<h2>Chi tiết đơn hàng</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderDetails as $index => $detail): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= Html::encode($detail->product_name) ?></td>
                <td><?= $detail->quantity ?></td>
                <td><?= Yii::$app->formatter->asCurrency($detail->price) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>