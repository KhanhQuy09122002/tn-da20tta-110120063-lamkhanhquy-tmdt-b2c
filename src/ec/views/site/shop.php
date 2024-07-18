<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>
<div class="login-form">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
    <div class="container">
        <div class="text-center mb-4">
            <h4>Đăng ký Shop trên Sellify </h4>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-username">Tên Shop</label>
                    <input type="text" id="users-username" class="form-control" name="Users[username]" placeholder="Tên Shop" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-password">Logo Shop</label>
                    <input type="file" id="users-password" class="form-control" name="shop[logo_shop]" placeholder="" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-name">Mô tả Shop </label>
                    <input type="text" id="users-name" class="form-control" name="shop[des_shop]" placeholder="Mô tả Shop" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-email">Địa chỉ đăng ký kinh doanh</label>
                    <input type="email" id="users-email" class="form-control" name="shop[addrest_shop]" placeholder="Địa chỉ đăng ký kinh doanh" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-address">Email điện tử</label>
                    <input type="text" id="users-address" class="form-control" name="shop[email]" placeholder="Email điện tử" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-address">Số điện thoai </label>
                    <input type="text" id="users-address" class="form-control" name="shop[phone]" placeholder="Số điện thoại" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-phone">Loại hình kinh doanh </label>
                    <select id="users-business-type" class="form-control" name="shop[business_type]" required>
                        <option value="" disabled selected hidden>Loại hình kinh doanh</option>
                        <option value="retail">Cá nhân</option>
                         <option value="wholesale">Tổ chức</option>
                        <option value="manufacturing">Doanh nghiệp</option>
                         
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-phone">Mã số thuế </label>
                    <input type="text" id="users-phone" class="form-control" name="shop[tax_id]" placeholder="Mã số thuế" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-phone">Phương thức vận chuyển  </label>
                    <select id="users-phone" class="form-control" name="shop[sm_id]" required>
                    <option value="" disabled selected hidden>Phương thức vận vận chuyển</option>
                    <option value="1">Giao hàng nhanh</option>
                    <option value="2">Giao hàng tiết kiệm</option>
                    <option value="3">Nhận tại cửa hàng</option>
             </select>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-phone">Giấy phép kinh doanh </label>
                    <input type="file" id="users-phone" class="form-control" name="shop[business_license]" placeholder="Giấy phép kinh doanh" required>
                </div>
            </div>
            
            <input type="hidden" id="users-status" name="shop[status]" value="1">
            <input type="hidden" id="register" name="register" value="1">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Đăng ký</button>
            </div>
        </div>
        <div class="register-link m-t-15 text-center">
            <?= Html::a('Trở lại', ['/site/login'], ['style' => 'text-decoration: none;']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
