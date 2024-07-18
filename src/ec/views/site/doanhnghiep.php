
<?php

/** @var yii\web\View $this */
/** @var app\models\Shop $shop */

use yii\bootstrap5\Html;
$this->title = 'Kênh doanh nghiệp';
?>
<div class="container">
    <img src="/images/logodn.png" alt="Ảnh minh họa" width="180" height="180">
  
   

    <?php if ($shop && $shop->status == 1): ?>
        <p>Bạn đã đăng ký shop rồi và đang chờ kiểm duyệt.</p>
    <?php else: ?>
      <h5>Chào mừng đến với Sellify!</h5>
      <p>Vui lòng cung cấp thông tin để thành lập tài khoản người bán trên Sellify</p>
        <?= Html::a('Bắt đầu đăng ký', ['/shop/create'], ['class' => 'btn btn-primary']) ?><br>
    <?php endif; ?>
</div>
