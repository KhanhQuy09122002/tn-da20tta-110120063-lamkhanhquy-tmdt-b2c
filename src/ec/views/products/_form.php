<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Categories;


?>

<div class="products-form container">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'product_code')->textInput(['maxlength' => true, 'placeholder' => 'Nhập mã sản phẩm'])->label('Mã sản phẩm') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'product_name')->textInput(['maxlength' => true, 'placeholder' => 'Nhập tên sản phẩm', 'id' => 'product-name'])->label('Tên sản phẩm') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'product_price')->textInput(['type' => 'number', 'placeholder' => 'Nhập giá sản phẩm'])->label('Giá sản phẩm (VNĐ)') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'product_quantity')->textInput(['type' => 'number', 'placeholder' => 'Nhập số lượng sản phẩm'])->label('Số lượng') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cate_id')->dropDownList(
                ArrayHelper::map(Categories::find()->all(), 'id', 'cate_name'),
                ['prompt' => '', 'id' => 'category-id']
            )->label('Danh mục') ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, '')->dropDownList(
                ArrayHelper::map(Categories::find()->all(), 'id', 'cate_name'),
                ['prompt' => '', 'id' => 'category-id']
            )->label('Danh mục') ?>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'product_image')->fileInput()->label('Ảnh sản phẩm') ?>
            <?php if ($model->product_image): ?>
                <?= Html::img($model->product_image, ['class' => 'img-responsive', 'style' => 'max-width: 200px; margin-top: 10px;']) ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'detail')->textarea(['rows' => 6, 'placeholder' => 'Nhập chi tiết sản phẩm'])->label('Chi tiết sản phẩm') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'describe')->textarea(['rows' => 6, 'placeholder' => 'Nhập mô tả sản phẩm'])->label('Mô tả sản phẩm') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Lưu', ['class' => 'btn btn-success btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(function() {
    $('#product-name').on('blur', function() {
        var productName = $(this).val();
        $.ajax({
            url: 'index.php?r=product/get-category-by-product-name',
            dataType: 'json',
            data: {
                productName: productName
            },
            success: function(data) {
                if (data) {
                    $('#category-id').val(data.id);
                }
            }
        });
    });
});
JS;
$this->registerJs($script);
?>
