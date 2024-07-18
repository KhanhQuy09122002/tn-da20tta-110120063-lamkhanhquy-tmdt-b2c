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
            <h4>Đăng ký</h4>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-username">Tên đăng nhập</label>
                    <input type="text" id="users-username" class="form-control" name="Users[username]" placeholder="Tên đăng nhập" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-password">Mật khẩu</label>
                    <input type="password" id="users-password" class="form-control" name="Users[password]" placeholder="Mật khẩu" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-name">Họ tên</label>
                    <input type="text" id="users-name" class="form-control" name="Users[fullname]" placeholder="Họ tên" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-email">Email</label>
                    <input type="email" id="users-email" class="form-control" name="Users[email]" placeholder="Email" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-address">Địa chỉ</label>
                    <input type="text" id="users-address" class="form-control" name="Users[address]" placeholder="Địa chỉ" required>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="users-phone">Điện thoại</label>
                    <input type="text" id="users-phone" class="form-control" name="Users[phone]" placeholder="Điện thoại" required>
                </div>
            </div>
            <input type="hidden" id="users-role" name="Users[role]" value="1">
            <input type="hidden" id="users-status" name="Users[status]" value="1">
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
