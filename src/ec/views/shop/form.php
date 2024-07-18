<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>
<div class="shop-register-form">
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'form-horizontal'],
    ]); ?>
    <div class="container">
        <div class="text-center mb-4">
            <h4>Duyệt Shop</h4>
        </div>
        <div class="row">
        <div class="d-flex justify-content-center">
    <div class="col-md-6 mb-3">
        <?= $form->field($model, 'status')->dropDownList([
            '' => 'Trạng thái Shop',
            '1' => 'Chờ duyệt',
            '2' => 'Đã duyệt',
            '3' => 'Tạm dừng',
        ], ['class' => 'form-control']) ?>
    </div>
</div>

            
            <div class="col-12 text-center">
                <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary btn-flat m-b-30 m-t-30']) ?>
            </div>
        </div>
        
    </div>
    <?php ActiveForm::end(); ?>
</div>
