
<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;
$this->title = 'Kênh doanh nghiệp';
?>
  <div class="container">
        <img src="/images/logodn.png" alt="Ảnh minh họa" width="180" height="180">
        <h5>Đăng ký thành công!</h5>
        <p>Vui lòng chờ hệ thống xét duyệt và thường xuyên kiểm tra email, hệ thống sẽ phản hồi trong thời gian nhanh nhất nhanh nhất !</p>
        <?= Html::a('Trở lại', ['index'], ['class' => 'btn']) ?>
    </div>