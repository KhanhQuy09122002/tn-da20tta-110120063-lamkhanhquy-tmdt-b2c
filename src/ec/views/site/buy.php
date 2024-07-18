<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
$this->title = 'Mua hàng';
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center text-danger">Mua hàng cùng Sellifly</h4>
            
            <div class="buyer-info border p-3 mb-4">
   
    <p class="card-text"><i class="fas fa-user"></i> <strong>Tên người mua:</strong> <span class="text-danger"><?= Html::encode($user->fullname) ?></span></p>
    <p class="card-text"><i class="fas fa-map-marker-alt"></i> <strong>Địa chỉ:</strong> <span class="text-danger"><?= Html::encode($user->address) ?></span></p>
    <p class="card-text"><i class="fas fa-phone"></i> <strong>Số điện thoại:</strong> <span class="text-danger"><?= Html::encode($user->phone) ?></span></p>
    <p class="card-text"><i class="fas fa-envelope"></i> <strong>Email:</strong> <span class="text-danger"><?= Html::encode($user->email) ?></span></p>
</div>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $productId => $item): ?>
                        <tr>
                            <td><?= Html::encode($item['product_name']) ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item['price'], 0) ?> VND</td>
                            <td><?= Html::encode($item['quantity']) ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item['price'] * $item['quantity'], 0) ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Tổng tiền:</strong></td>
                        <td><strong><?= Yii::$app->formatter->asDecimal($total, 0) ?> VND</strong></td>
                    </tr>
                </tbody>
            </table>
           


            <div class="form-group">
                <?= Html::beginForm(['site/confirm-buy'], 'post') ?>

                <!-- Dropdown list cho phương thức thanh toán -->
                <?= Html::label('Chọn phương thức thanh toán', 'payment_method', ['class' => 'form-label']) ?>
                <?= Html::dropDownList('payment_method', null, [
                    '1' => 'Thanh toán khi nhận hàng',
                    '2' => 'Chuyển khoản ngân hàng',
                    '3' => 'Thanh toán qua ví điện tử',
                ], ['class' => 'form-control mb-3', 'prompt' => 'Chọn phương thức thanh toán...']) ?>
              
                <?= Html::submitButton('Mua', ['class' => 'btn btn-primary']) ?>

                <?= Html::endForm() ?>
            </div>
        </div>
      
    </div>
 
</div>
