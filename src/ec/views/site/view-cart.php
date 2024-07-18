<?php
use yii\web\View;
use yii\helpers\Html;
$this->title = 'Giỏ hàng';

$total = 0;
// Kiểm tra và tạo chuỗi thông báo lỗi
$cartErrors = Yii::$app->session->getFlash('cartErrors', []);
$errorsJsArray = json_encode($cartErrors);

$script = <<<JS
    var errors = $errorsJsArray;
    if (errors.length > 0) {
        var message = errors.join('\\n');
        alert(message);
    }
JS;

$this->registerJs($script, View::POS_END);
?>
?>

<div class="container mt-4">
    <div class="card">
        <h5 class="card-header">Giỏ hàng của bạn</h5>
        <div class="card-body">
            <?= Html::beginForm(['site/update-cart'], 'post') ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                      
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $productId => $item): ?>
                        <tr>
                            <td><?= isset($item['product_name']) ? Yii::$app->formatter->asHtml($item['product_name']) : 'Unknown' ?></td>
                            <td><?= isset($item['price']) ? Yii::$app->formatter->asDecimal($item['price'], 0) . ' VND' : 'Unknown' ?></td>
                            <td><?= Html::textInput("quantity[$productId]", $item['quantity'], ['class' => 'form-control', 'type' => 'number', 'min' => 1]) ?></td>
                            <td><?= isset($item['price']) && isset($item['quantity']) ? Yii::$app->formatter->asDecimal($item['price'] * $item['quantity'], 0) . ' VND' : 'Unknown' ?></td>
                            <td>
                                <?= Html::a('<i class="fas fa-trash-alt"></i>', ['site/remove-from-cart', 'product_id' => $productId], [
                                    'class' => 'btn btn-link text-danger',
                                    'data' => [
                                        'confirm' => 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['quantity']; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-right">
            <p style="color: red;">Tổng tiền: <?= Yii::$app->formatter->asDecimal($total, 0) ?> VND</p>

                <?= Html::submitButton('Cập nhật giỏ hàng', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Tiếp tục mua hàng', ['site/index'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Mua ngay', ['site/buy'], ['class' => 'btn btn-danger']) ?>

            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


