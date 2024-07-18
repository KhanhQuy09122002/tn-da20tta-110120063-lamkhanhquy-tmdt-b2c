<?php
use yii\widgets\LinkPager;
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Kênh người bán';
?>

<div class="header-container d-flex align-items-center mb-4">
    <?= Html::img('/images/logo.png', ['alt' => 'Header Image', 'class' => 'header-image']) ?>
    <h1 class="ms-3"><?= Html::encode($this->title) ?></h1>
</div>


<?php
$css = <<<CSS
.header-container {
    background-color: #f8f9fa; /* Màu nền nhẹ */
    padding: 20px; /* Khoảng cách bên trong để tạo không gian xung quanh ảnh và tiêu đề */
    border-radius: 10px; /* Bo tròn các góc của khung chứa */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng để khung chứa nổi bật hơn */
}

.header-image {
    width: 100px; /* Kích thước ảnh phù hợp */
    height: auto; /* Giữ nguyên tỷ lệ của ảnh */
    border-radius: 50%; /* Tạo ảnh hình tròn nếu muốn */
    object-fit: cover; /* Đảm bảo ảnh không bị méo */
}

h1 {
    font-size: 1.5rem; /* Kích thước chữ của tiêu đề */
    color: #343a40; /* Màu chữ của tiêu đề */
    margin: 0; /* Loại bỏ khoảng cách mặc định của thẻ h1 */
}

CSS;
$this->registerCss($css);
?>
