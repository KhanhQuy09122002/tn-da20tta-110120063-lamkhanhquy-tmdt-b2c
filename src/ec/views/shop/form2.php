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
            <h4>Đăng ký Shop trên Sellify</h4>
        </div>
        <div class="row">
       
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'shop_name')->textInput(['placeholder' => 'Tên Shop', 'class' => 'form-control']) ?>
            </div>
           
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'des_shop')->textarea(['rows' => 6, 'placeholder' => 'Mô tả Shop', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'address_shop')->textInput(['placeholder' => 'Địa chỉ đăng ký kinh doanh', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Email điện tử', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Số điện thoại', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'business_type')->dropDownList([
                    '' => 'Loại hình kinh doanh',
                    '1' => 'Cá nhân',
                    '2' => 'Tổ chức',
                    '3' => 'Doanh nghiệp'
                ], ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'tax_id')->textInput(['placeholder' => 'Mã số thuế', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6 mb-3">
                <?= $form->field($model, 'sm_id')->dropDownList([
                    '' => 'Phương thức vận chuyển',
                    '1' => 'Giao hàng nhanh',
                    '2' => 'Giao hàng tiết kiệm',
                    '3' => 'Nhận tại cửa hàng'
                ], ['class' => 'form-control']) ?>
            </div>
           

            
            <div class="col-12 text-center">
                <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary btn-flat m-b-30 m-t-30']) ?>
            </div>
         
        </div>
       
    </div>
    <?php ActiveForm::end(); ?>
</div>
