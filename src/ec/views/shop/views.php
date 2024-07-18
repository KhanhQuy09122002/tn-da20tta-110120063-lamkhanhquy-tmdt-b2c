<?php
/** @var yii\web\View $this */
/** @var app\models\Shop $shop */
/** @var bool $isFollowing */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Thông tin shop: ' . $shop->shop_name;
$this->params['breadcrumbs'][] = $this->title;

// Sản phẩm của shop
$products = $shop->getProducts()->all();
?>

<div class="container my-4">
    <div class="card shop-info p-3">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="d-flex flex-column align-items-center">
                    <div class="rounded-circle overflow-hidden border border-primary mb-3" style="width: 100px; height: 100px;">
                        <img src="<?= Html::encode($shop->logo_shop) ?>" alt="<?= Html::encode($shop->shop_name) ?>" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-3"><span class="text-primary font-weight-bold"><?= Html::encode($shop->shop_name) ?></span></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-db"><b class="text-muted"><i class="fas fa-map-marker-alt"></i></b> <?= Html::encode($shop->address_shop) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-db"><b class="text-muted"><i class="fas fa-phone-alt"></i></b> <?= Html::encode($shop->phone) ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-db"><b class="text-muted"><i class="fas fa-envelope"></i></b> <?= Html::encode($shop->email) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-db"><b class="text-muted"><i class="fas fa-box"></i></b> <?= count($products) ?> sản phẩm</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button id="follow-btn" class="btn <?= $isFollowing ? 'btn-danger' : 'btn-success' ?>" data-shop-id="<?= $shop->id ?>" data-following="<?= $isFollowing ? 1 : 0 ?>">
                            <?= $isFollowing ? 'Bỏ theo dõi' : 'Theo dõi' ?> <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="shop-products mb-4">
        <h3 class="section-title">Sản phẩm của shop</h3>
        <div class="products">
            <div class="row">
                <?php if (isset($products) && count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-2_4 mb-4">
                            <a href="<?= Url::to(['/site/detail', 'id' => $product->product_id]) ?>">
                                <div class="product-item card h-60 "style="height: 350px;">
                                    <img class="product-image" src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>">  </a>
                                    <div class="product-info text-center mt-2">
                                    <p class="product-name"><?= Html::encode($product->product_name) ?></p><br>
                                    <span class="original-price">
  
    <span style="background-color: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
        <?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ
    </span>
</span>
                                </div>
                                </div>
                               
                          
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
/* Custom CSS to style the follow/unfollow button */
.btn-success {
    background-color: #ff5a5f;
    border-color: #ff5a5f;
}
.btn-success:hover {
    background-color: #e14a4f;
    border-color: #e14a4f;
}
.btn-danger {
    background-color: #ffcc00;
    border-color: #ffcc00;
}
.btn-danger:hover {
    background-color: #e6b800;
    border-color: #e6b800;
}
.col-md-2_4 {
    width: 20%;
    float: left;
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.product-item {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow 0.3s;
    background-color: #fff;
}
.product-item:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.product-info {
    padding: 10px;
}
.product-name {
    margin-bottom: 10px;
    line-height: 1.2;
}
.btn-danger {
    display: inline-block;
}
.btn-danger .price-currency {
    margin-top: 0;
}
CSS;
$this->registerCss($css);

$js = <<<JS
$(document).ready(function() {
    $('#follow-btn').click(function() {
        var button = $(this);
        var shopId = button.data('shop-id');
        var following = button.data('following');

        var url = following ? '/shop/unfollow' : '/shop/follow';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: shopId,
                _csrf: yii.getCsrfToken()
            },
            success: function(response) {
                if (response.status === 'success') {
                    if (following) {
                        button.removeClass('btn-danger').addClass('btn-success');
                        button.data('following', 0);
                        button.html('<i class="fas fa-plus"></i> Theo dõi');
                    } else {
                        button.removeClass('btn-success').addClass('btn-danger');
                        button.data('following', 1);
                        button.html('Bỏ theo dõi');
                    }
                } else {
                    alert('Đã xảy ra lỗi: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi: ' + xhr.responseText);
            }
        });
    });
});
JS;
$this->registerJs($js);
?>
