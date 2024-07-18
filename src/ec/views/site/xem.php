<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\Html;

$this->title = 'Danh sách sản phẩm tìm kiếm theo từ khóa "' . Html::encode(Yii::$app->request->get('search')) . '"';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products card"style="margin-bottom: 20px;">
    <div class="card-body">
        <?php if (!empty($products)) : ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-2 mb-4 product-wrapper">
                        <div class="product-item card h-60"style="height: 350px;">
                            <a href="<?= yii\helpers\Url::to(['/site/detail', 'id' => $product->product_id]) ?>">
                                <img class="product-image card-img-top" src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>">
                            </a>
                            <div class="card-body text-center p-2">
                                <p class="product-name mb-1"><?= Html::encode($product->product_name) ?></p><br>
                                <span class="original-price">
    <br>
    <span style="background-color: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
        <?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ
    </span>
</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-center">Không tìm thấy sản phẩm nào.</p>
        <?php endif; ?>
    </div>
</div>



