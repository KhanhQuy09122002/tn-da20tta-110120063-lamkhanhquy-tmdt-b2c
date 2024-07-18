
<?php

/** @var yii\web\View $this */
/** @var app\models\Product $product */

use yii\bootstrap5\Html;
use app\models\Shop;
use app\models\OrderDetail;
//$this->title = $product->product_name;
//$this->title = 'Chi tiết sản phẩm';
//$this->params['breadcrumbs'][] = $this->title;
$this->title = 'Chi tiết sản phẩm: ' . $product->product_name;


//$this->params['breadcrumbs'][] = $product->product_name;
$this->title = 'Chi tiết sản phẩm: ' . $product->product_name;
if ($product->category !== null) {
    $this->title .= ' - ' . $product->category->cate_name;
}

if ($product->category !== null) {
    $this->params['breadcrumbs'][] = ['label' => $product->category->cate_name];
}
$this->params['breadcrumbs'][] = ['label' => $product->product_name];
// Xác định trạng thái sản phẩm dựa trên số lượng
$status = $product->product_quantity > 0 ? 'Còn hàng' : 'Hết hàng';
?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Hiển thị hình ảnh sản phẩm -->
            <img src="<?= Html::encode($product->product_image) ?>" alt="<?= Html::encode($product->product_name) ?>" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-8">
            <!-- Hiển thị thông tin sản phẩm -->
            <div class="product-info p-3 border rounded shadow-sm bg-white">
                <h2 class="mb-3"><?= Html::encode($product->product_name) ?></h2>
                
                <?php if ($product->discount): ?>
                    <?php
                    $discountedPrice = $product->product_price * (1 - $product->discount / 100);
                    ?>
                    <p class="price">
                        <p class="original-price">
                            Giá gốc: <strike><?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> VND</strike>
                        </span>
                        <br>
                        <p class="discounted-price text-danger">
                            Giá khuyến mãi: <?= Yii::$app->formatter->asDecimal($discountedPrice, 0) ?> VND
                        </span>
                        <br>
                     
                    </p>
                <?php else: ?>
                    <p class="text-danger">
                        Giá: <?= Yii::$app->formatter->asDecimal($product->product_price, 0) ?> VND
                    </p>
                <?php endif; ?>
                
                <p><b>Mã code sản phẩm:</b> <?= Html::encode($product->product_code) ?></p>
                <p><b>Danh mục:</b> <?= Html::encode($product->category->cate_name) ?></p>
                <p><b>Trạng thái:</b> <?= Html::encode($status) ?></p>
                
            

                <?php if ($product->product_quantity > 0) : ?>
                    <?php if (!Yii::$app->user->isGuest) : ?>
                        <div class="input-group mb-3">
                            <?= Html::a('Thêm vào giỏ hàng', ['site/add-to-cart', 'product_id' => $product->product_id], [
                                'class' => 'btn btn-primary',
                                'id'=>"addToCartBtn",
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    <?php else : ?>
                        <?= Html::a('Đăng nhập để mua hàng', ['site/login'], [
                            'class' => 'btn btn-info mt-3',
                        ]) ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<div class="container my-4">
    <div class="card shop-info p-3">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center">
                    <div class="rounded-circle overflow-hidden border border-primary mb-3" style="width: 100px; height: 100px;">
                        <img src="<?= Html::encode($product->shop->logo_shop) ?>" alt="<?= Html::encode($product->shop->shop_name) ?>" class="img-fluid">
                    </div>
                    <div class="text-center">
                        <?= Html::a('<i class="fas fa-eye"></i> Xem shop', ['shop/views', 'id' => $product->shop_id], ['class' => 'btn btn-primary']) ?>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <h4 class="mb-3"><span class="text-primary font-weight-bold"><?= Html::encode($product->shop->shop_name) ?></span></h4>
                <div class="row">
                    <div class="col-md-6">
                        <p class ="text-db"><b class="text-muted">Địa chỉ:</b> <?= Html::encode($product->shop->address_shop) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class ="text-db"><b class="text-muted">Số điện thoại:</b> <?= Html::encode($product->shop->phone) ?></p>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <p class ="text-db"><b class="text-muted">Email:</b> <?= Html::encode($product->shop->email) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class ="text-db"><b class="text-muted">Số lượng sản phẩm:</b> <?= Html::encode($product->shop->getProducts()->count()) ?></p>
                    </div>
                    <!-- Thêm các trường thông tin khác của shop ở đây -->
                </div>
            </div>
        </div>
    </div>
</div>










<div class="container my-4">
    <div class="details-and-description p-4 border rounded shadow-sm bg-white">
        <p ><b>CHI TIẾT SẢN PHẨM</b><br>
        <p><?= Html::decode($product->detail) ?></p>
        <p ><b>MÔ TẢ SẢN PHẨM</b><br> 
        <p><?= Html::decode($product->describe) ?></p>
    </div>
</div>


    <div class="container">
    <!-- ... (các phần thông tin sản phẩm) ... -->

    <div class="row mt-4">
   
</div>


   


<div class="container my-4">
<!-- Hiển thị thông tin sản phẩm -->
<!-- Hiển thị bình luận -->
<div class="comments mt-4">
    <h4 class="text-center mb-4 custom-red">ĐÁNH GIÁ CỦA KHÁCH HÀNG</h4>
    <?php foreach ($product->comments as $comment): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($comment->user->username) ?></h5>
            <!-- Thay thế phần nội dung bình luận bằng trường nhập văn bản TinyMCE -->
            <div class="card-text"><?= $comment->content ?></div>
            <!-- Kết thúc thay thế -->
            <p class="card-text"><small class="text-muted">Đăng lúc: <?= Yii::$app->formatter->asDatetime($comment->created_at) ?></small></p>
            
            <!-- Nút để hiển thị các câu trả lời -->
            <?php if (count($comment->replies) > 0): ?>
                <a href="#" class="show-replies" data-comment-id="<?= $comment->id ?>">
                    Hiển thị <?= count($comment->replies) ?> câu trả lời
                </a>
            <?php endif; ?>

            <!-- Hiển thị câu trả lời (ẩn ban đầu) -->
            <div class="replies mt-3" id="replies-<?= $comment->id ?>" style="display: none;">
            <?php foreach ($comment->replies as $reply): ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <?php 
                            // Tìm thông tin shop
                            $shopName = Shop::find()->where(['user_id' => $reply->user_id])->one();
                            // Kiểm tra xem tên shop có tồn tại không và gán giá trị tương ứng
                            $shopName = isset($shopName->shop_name) ? Html::encode($shopName->shop_name) : "Không rõ";
                        ?>
                        <h6 class="card-title"><?= $shopName ?></h6>
                        <div class="card-text"><?= $reply->content ?></div>
                        <p class="card-text"><small class="text-muted">Đăng lúc: <?= Yii::$app->formatter->asDatetime($reply->created_at) ?></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>




  
<?php
// Kiểm tra xem người dùng đã mua sản phẩm hay chưa
$userId = Yii::$app->user->id;
$productPurchased = false; // Biến để xác định liệu người dùng đã mua sản phẩm hay chưa

// Tìm đơn hàng của người dùng cho sản phẩm này
$orderDetail = OrderDetail::find()
    ->joinWith('order')
    ->where(['orders.user_id' => $userId, 'order_detail.product_id' => $product->product_id])
    ->one();

if ($orderDetail !== null) {
    $productPurchased = true;
}
?>

<?php if (!Yii::$app->user->isGuest && $productPurchased): ?>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Viết bình luận của bạn</h5>
            <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['comments/create']]); ?>
            <?= $form->field($newComment, 'content')->widget(\dosamigos\tinymce\TinyMce::className(), [
                'options' => ['rows' => 6],
                'language' => 'vi',
                'clientOptions' => [
                    'plugins' => [
                        'anchor', 'charmap', 'code', 'help', 'hr',
                        'image', 'link', 'lists', 'media', 'paste',
                        'searchreplace', 'table',
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",  // Thêm nút hình ảnh vào thanh công cụ
                    'image_advtab' => true,  // Cho phép thêm tab tùy chọn nâng cao cho hình ảnh
                    'images_upload_url' => \yii\helpers\Url::to(['comments/upload-image']),  // URL để xử lý tải lên hình ảnh
                    'automatic_uploads' => true,  // Tự động tải lên hình ảnh khi chọn
                    'file_picker_types' => 'image',  // Loại tệp có thể chọn (image, media, file)
                    'file_picker_callback' => new \yii\web\JsExpression("
                        function(callback, value, meta) {
                            if (meta.filetype == 'image') {
                                var input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');
                                input.onchange = function() {
                                    var file = this.files[0];
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var id = 'blobid' + (new Date()).getTime();
                                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                        var base64 = reader.result.split(',')[1];
                                        var blobInfo = blobCache.create(id, file, base64);
                                        blobCache.add(blobInfo);
                                        callback(blobInfo.blobUri(), { title: file.name });
                                    };
                                    reader.readAsDataURL(file);
                                };
                                input.click();
                            }
                        }
                    "),
                ]
            ])->label(false); ?>
            <?= $form->field($newComment, 'product_id')->hiddenInput(['value' => $product->product_id])->label(false) ?>
            <?= $form->field($newComment, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
            <?= \yii\helpers\Html::submitButton('Gửi bình luận', ['class' => 'btn btn-primary']) ?>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
<?php endif; ?>






<p style="text-align: center;"><b>CÁC SẢN PHẨM TƯƠNG TỰ</b></p>

<div class="products">
    <div class="row">
        <?php
        // Lấy danh sách các sản phẩm cùng danh mục và không phải là sản phẩm hiện tại
        $relatedProducts = \app\models\Products::find()
            ->where(['<>', 'product_id', $product->product_id]) // Loại bỏ sản phẩm hiện tại
            ->andWhere(['cate_id' => $product->cate_id]) // Lọc theo cùng danh mục
            ->limit(4) // Giới hạn chỉ lấy 4 sản phẩm
            ->all();

        foreach ($relatedProducts as $relatedProduct): ?>
            <div class="col-md-3">
                <a href="<?= yii\helpers\Url::to(['site/detail', 'id' => $relatedProduct->product_id]) ?>">
                    <div class="product-item">
                        <a href="<?= yii\helpers\Url::to(['site/detail', 'id' => $relatedProduct->product_id]) ?>">
                            <img class="product-image" src="<?= Html::encode($relatedProduct->product_image) ?>" alt="<?= Html::encode($relatedProduct->product_name) ?>">
                        </a>
                        <div class="product-info">
                            <h2><?= Html::encode($relatedProduct->product_name) ?></h2>
                            <p><b>Giá:</b> <?= Yii::$app->formatter->asDecimal($relatedProduct->product_price, 0) ?> VND</p>
                            <!-- Các thông tin khác của sản phẩm -->
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php
$script = <<<JS
    $('.show-replies').click(function(e) {
        e.preventDefault();
        var commentId = $(this).data('comment-id');
        $('#replies-' + commentId).toggle();
    });

    $('.reply-button').click(function() {
        var commentId = $(this).data('comment-id');
        $('#reply-form-' + commentId).toggle();
    });
JS;
$this->registerJs($script);

?>

<?php
$css = <<<CSS
  .voucher-card {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease-in-out;
    }

    .voucher-card:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 1.2rem;
        color: #007bff;
    }

    .card-text {
        font-size: 0.9rem;
        color: #333;
    }
    
CSS;
$this->registerCss($css);
?>







