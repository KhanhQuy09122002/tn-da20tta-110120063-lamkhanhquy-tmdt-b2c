<?php
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
use yii\bootstrap5\Html;
use yii\helpers\Url;
$this->title = 'Sellify';


?>
<div class="ad-popup" id="adPopup">
    <div class="ad-content">
        <span class="close-btn" id="closeBtn">&times;</span>
        <img src="/images/logo6.jpg" alt="Ad Banner Full" class="ad-image">
    </div>
</div>

<div class="slide-wrapper">
    <div class="slide-container" id="slideContainer">
        <div class="slide"><img src="/images/logo1.jpg" alt="Slide 1"></div>
        <div class="slide"><img src="/images/logo2.jpg" alt="Slide 2"></div>
        <div class="slide"><img src="/images/logo3.jpg" alt="Slide 3"></div>
        <div class="slide"><img src="/images/logo4.jpg" alt="Slide 3"></div>
        <div class="slide"><img src="/images/logo5.jpg" alt="Slide 3"></div>
    </div>
    <button class="nav-btn prev-btn" id="prevBtn">&lt;</button>
    <button class="nav-btn next-btn" id="nextBtn">&gt;</button>
    <div class="nav-dots" id="navDots"></div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    const slideContainer = document.getElementById('slideContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const navDots = document.getElementById('navDots');

    function updateSlidePosition() {
        slideContainer.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
        document.querySelectorAll('.nav-dots button').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    function createNavDots() {
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('button');
            dot.addEventListener('click', () => {
                currentSlide = i;
                updateSlidePosition();
            });
            navDots.appendChild(dot);
        }
    }

    function nextSlide() {
        currentSlide = (currentSlide === totalSlides - 1) ? 0 : currentSlide + 1;
        updateSlidePosition();
    }

    prevBtn.addEventListener('click', () => {
        currentSlide = (currentSlide === 0) ? totalSlides - 1 : currentSlide - 1;
        updateSlidePosition();
    });

    nextBtn.addEventListener('click', nextSlide);

    createNavDots();
    updateSlidePosition();

    // Tự động chuyển slide sau mỗi 5 giây
    setInterval(nextSlide, 5000);

    // Quảng cáo popup

</script>

<br>
<div class="container">
    <div class="card p-4">
        <div class="categories">
            <h2 class="mb-4" style="text-align: left; color: #000000; font-weight: bold;">Danh mục</h2>
            <div class="card-body d-flex flex-wrap">
                <?php foreach ($categories as $category): ?>
                    <div class="col-md-2 mb-4">
                        <div class="category-item card text-center h-100">
                            <a href="<?= Url::to(['site/category', 'id' => $category->id]) ?>">
                                <div class="category-image-container">
                                    <img class="category-image" src="<?= Html::encode($category->cate_image) ?>" alt="<?= Html::encode($category->cate_name) ?>">
                                </div>
                            </a>
                            <div class="card-body">
                                <p class="category-name"><?= Html::encode($category->cate_name) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<br>


<div class="products card" style="margin-bottom: 20px;">
<h2 style="text-align: left; margin-bottom: 0px; color: #000000; font-weight: bold;">Các sản phẩm nổi bật</h2>

    <div class="card-body">
        <div class="row">
            <?php if (isset($products) && count($products) > 0): ?>
                <?php foreach ($products as $index => $product): ?>
    <div class="col-md-2 mb-4 product-wrapper" >
        <div class="product-item card h-60" style="height: 350px;">
            <a href="<?= yii\helpers\Url::to(['/site/detail', 'id' => $product->product_id]) ?>">
                <img class="product-image card-img-top" src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>">
            </a>
            <div class="card-body text-center">
                <p class="product-name"><?= Html::encode($product->product_name) ?></p>
                <p class="price text-danger">
                    <?php if ($product->discount): ?>
                        <?php $discountedPrice = $product->product_price * (1 - $product->discount / 100); ?>
                        <span class="original-price">
                            <strike><?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ</strike>
                                <span style="color: grey; margin-left: 3px;">-<?= $product->discount ?>%</span>
                        </span>

                        <br>
                        <span class="discounted-price">
    <span style="background-color:#ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
        <?= Yii::$app->formatter->asDecimal($discountedPrice, 0) ?> đ
    </span>
</span>

                    <?php else: ?>
                        <span class="original-price">
    <br>
    <span style="background-color: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
        <?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> đ
    </span>
</span>


                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
<?php endforeach; ?>

            <?php else: ?>
                <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
            <?php endif; ?>
        </div>

      
        <?php if (!empty($productsForYou)): ?>
            <h2 style="text-align: left; margin-bottom: 0px; color: #000000; font-weight: bold;">Dành cho bạn</h2><br>
    <div class="products-for-you card" style="margin-bottom: 20px;">
        
        <div class="card-body">
            <div class="row">
                <?php foreach ($productsForYou as $product): ?>
                    <div class="col-md-2 mb-4 product-wrapper">
                        <div class="product-item card h-60" style="height: 350px;">
                            <a href="<?= yii\helpers\Url::to(['/site/detail', 'id' => $product->product_id]) ?>">
                                <img class="product-image card-img-top" src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>">
                            </a>
                            <div class="card-body text-center">
                                <p class="product-name"><?= Html::encode($product->product_name) ?></p><br>
                                <span class="discounted-price">
    <span style="background-color:#ff5722; color: white; padding: 5px 10px; border-radius: 5px; display: inline-block;">
        <?= Yii::$app->formatter->asDecimal($discountedPrice, 0) ?> đ
    </span>
</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    
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




<style>
    .ad-popup {
        display: none; /* Bắt đầu với trạng thái ẩn */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Màu nền đen với độ trong suốt */
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    .ad-content {
        position: relative;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 90%;
        max-height: 90%;
    }
    .ad-image {
        max-width: 100%;
        max-height: 80vh; /* Giới hạn chiều cao của ảnh để không chiếm hết màn hình */
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }
    .ad-banner {
        margin: 20px 0;
        text-align: center;
    }
    .ad-banner img {
        max-width: 100%;
        height: auto;
    }
    .categories {
        padding-left: 10px;
        padding-right: 10px;
    }

    .category-item {
        padding: 10px;
        transition: transform 0.3s ease; /* Hiệu ứng chuyển động */
    }

    .category-item:hover {
        transform: translateY(-5px); /* Hiệu ứng khi di chuột vào */
    }

    .category-image-container {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-name {
        margin-top: 10px;
        font-weight: bold;
        text-align: center;
    }

  
</style>
<script>
    // JavaScript để thêm hiệu ứng khi click vào khung danh mục
    document.addEventListener('DOMContentLoaded', function() {
        let categoryItems = document.querySelectorAll('.category-item');

        categoryItems.forEach(function(item) {
            item.addEventListener('click', function() {
                // Sử dụng setTimeout để áp dụng lại hiệu ứng sau khi click
                setTimeout(function() {
                    item.style.transform = 'scale(1)'; // Trả lại kích thước ban đầu
                }, 300); // Thời gian delay, phù hợp với thời gian transition trong CSS
                item.style.transform = 'scale(0.95)'; // Hiệu ứng scale nhỏ lại khi click
            });
        });
    });
</script>



