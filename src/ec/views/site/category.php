<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

// Thiết lập tiêu đề từ tên danh mục
$this->title = Html::encode($category->cate_name);

// Thiết lập breadcrumb cho danh mục hiện tại
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>

<div class="container">
    <div class="row">
        <!-- Cột danh mục bên trái -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h2 style="text-align: left; color: #000000; font-weight: bold;">Tất cả danh mục</h2>
                    <div class="categories">
                        <?php foreach ($categories as $cate): ?>
                            <a href="<?= Url::to(['site/category', 'id' => $cate->id]) ?>" class="btn btn-outline-secondary mb-2">
                                <?= Html::encode($cate->cate_name) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột sản phẩm bên phải -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 style="text-align: left; color: #000000; font-weight: bold;">Sản phẩm</h2>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <select id="sort" class="form-control">
                                <option value="">Mặc định</option>
                                <option value="price-asc" <?= $sort == 'price-asc' ? 'selected' : '' ?>>Giá từ thấp đến cao</option>
                                <option value="price-desc" <?= $sort == 'price-desc' ? 'selected' : '' ?>>Giá từ cao đến thấp</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (isset($products) && count($products) > 0): ?>
                            <?php foreach ($products as $index => $product): ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100 product-item">
                                        <a href="<?= yii\helpers\Url::to(['/site/detail', 'id' => $product->product_id]) ?>">
                                            <img class="card-img-top product-image" src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>">
                                        </a>
                                        <div class="card-body d-flex flex-column justify-content-between text-center">
                                            <div>
                                                <p class="product-name"><?= Html::encode($product->product_name) ?></p>
                                            </div>
                                            <div>
                                                <p class="price text-danger">
                                                    <?php if ($product->discount): ?>
                                                        <?php $discountedPrice = $product->product_price * (1 - $product->discount / 100); ?>
                                                        <span class="original-price">
                                                            <strike><?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ</strike>
                                                            <span style="color: grey; margin-left: 3px;">-<?= $product->discount ?>%</span>
                                                        </span>
                                                        <br>
                                                        <span class="discounted-price">
                                                            <span style="background-color: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: flex; justify-content: center;">
                                                                <?= Yii::$app->formatter->asDecimal($discountedPrice, 0) ?> đ
                                                            </span>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="original-price">
                                                            <span style="background-color: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: flex; justify-content: center;">
                                                                <?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ
                                                            </span>
                                                        </span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
                        <?php endif; ?>

                        <?= LinkPager::widget([
                            'pagination' => $pagination,
                            'options' => ['class' => 'pagination justify-content-center'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                            'disabledListItemSubTagOptions' => ['class' => 'page-link disabled'],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$css = <<<CSS
/* Custom CSS for category and product display */
.categories {
    margin-bottom: 10px;
}

.categories .btn {
    margin-right: 5px;
}

.products .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.product-item {
    border: 1px solid #eaeaea;
    border-radius: 10px;
    transition: box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-item:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image-container {
    text-align: center;
    padding: 10px;
}

.product-image {
    max-width: 100%;
    max-height: 150px;
}

.product-name {
    font-size: 1.1em;
    font-weight: bold;
    margin: 10px 0;
}

.price {
    font-size: 1.2em;
}

.original-price, .discounted-price {
    display: block;
}

.discounted-price {
    background-color: #ff5722;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 5px;
}

/* CSS for pagination like Shopee */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-link {
    color: #000;
    border: none;
    background-color: transparent;
    font-size: 14px;
    padding: 5px 10px;
    margin: 0 2px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination .page-link:hover {
    background-color: #f0f0f0;
}

.pagination .page-item.active .page-link {
    background-color: #ee4d2d;
    color: #fff;
    border-color: #ee4d2d;
}

.pagination .page-item.disabled .page-link {
    pointer-events: none;
    color: #ccc;
}

.pagination .page-link:focus {
    box-shadow: none;
    outline: none;
}

CSS;

$this->registerCss($css);
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var sortValue = urlParams.get('sort');
    if (sortValue) {
        document.getElementById('sort').value = sortValue;
    }

    document.getElementById('sort').addEventListener('change', function() {
        var sortValue = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('sort', sortValue);
        window.location.href = url.href;
    });
});
</script>
