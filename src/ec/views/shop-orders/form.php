<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ShopOrders;

/** @var yii\web\View $this */
/** @var app\models\ShopOrders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="shop-orders-form" style="width: 50%; margin: 0 auto;">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            1 => 'Chưa duyệt',
            3 => 'Đã duyệt',
        ],
        ['prompt' => 'Select Status']
    )->label('Status', ['class' => 'control-label']) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
