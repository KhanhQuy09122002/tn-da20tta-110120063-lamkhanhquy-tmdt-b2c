<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Đăng nhập';
?>

<div class="site-login">
    <div class="login-container d-flex align-items-center justify-content-center">
        <div class="login-image">
            <img src="/images/logo.png" alt="Shop Image" class="img-fluid">
        </div>
        <div class="login-card">
            <div class="login-header">
                <h3 class="login-title">Đăng nhập</h3>
            </div>
            <div class="login-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "<div class='form-group'>{label}{input}{error}</div>",
                        'labelOptions' => ['class' => 'form-label'],
                        'inputOptions' => ['class' => 'form-input'],
                        'errorOptions' => ['class' => 'form-error'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Tên đăng nhập']) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Mật khẩu']) ?>
                <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class='form-group checkbox'>{input} {label}</div>"]) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
                </div>

                <div class="form-group text-center">
                    <p>Bạn chưa có tài khoản?</p>
                    <?= Html::a('Đăng ký', ['/site/register'], ['class' => 'link']) ?><br>
                    <?= Html::a('Trở lại', ['/site/index'], ['class' => 'link']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
