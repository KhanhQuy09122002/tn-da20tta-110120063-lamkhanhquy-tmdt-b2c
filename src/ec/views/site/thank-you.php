
<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;
$this->title = 'Thanks you';
?>
  <div class="container">
        <img src="/images/thankyou.png" alt="Ảnh minh họa" width="180" height="180">
        <h5>Đặt hàng thành công!</h5>
        <p>Cảm ơn quý khách hàng đã tin tưởng shop. Sản phẩm sẽ được giao trong thời gian nhanh nhất !</p>
        <?= Html::a('Trở lại', ['index'], ['class' => 'btn']) ?>
    </div>