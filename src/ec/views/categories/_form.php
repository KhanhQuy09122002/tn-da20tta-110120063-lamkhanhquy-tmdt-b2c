<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cate_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p_id')->dropDownList(
        ArrayHelper::map(\app\models\Categories::find()->all(), 'id', 'cate_name'),
        ['prompt' => 'Chọn ngành hàng cha']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
