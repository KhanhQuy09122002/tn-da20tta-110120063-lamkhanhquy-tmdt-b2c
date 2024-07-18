<?php
/* @var $this yii\web\View */
/* @var $vouchers app\models\Voucher[] */

use yii\helpers\Html;

$this->title = 'Ưu đãi';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-voucher container">
    <h4 class="text-center"><?= Html::encode($this->title) ?></h4>

    <div class="row">
        <?php foreach ($vouchers as $voucher): ?>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4 box-shadow w-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title"><?= Html::encode($voucher->voucher_code) ?></h5>
                            <button class="btn btn-outline-secondary btn-sm copy-button" data-code="<?= Html::encode($voucher->voucher_code) ?>">Copy</button>
                        </div>
                        <p class="card-text"><?= Html::encode($voucher->description) ?></p>
                        
                        <div class="details-section" style="display: none;">
                            <p class="card-text"><strong>Giảm giá:</strong> <?= $voucher->discount_percentage ?>%</p>
                            <p class="card-text"><strong>Hạn sử dụng:</strong> <?= Html::encode($voucher->end_date) ?></p>
                            <p class="card-text"><strong>Tình trạng:</strong> <?= $voucher->status == 1 ? 'Còn hiệu lực' : 'Hết hiệu lực' ?></p>
                        </div>

                        <a href="#" class="btn btn-link show-details">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const showDetailsLinks = document.querySelectorAll(".show-details");

    showDetailsLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            const detailsSection = this.parentNode.querySelector(".details-section");
            detailsSection.style.display = "block";
            this.style.display = "none";
        });
    });

    const copyButtons = document.querySelectorAll(".copy-button");

    copyButtons.forEach(button => {
        button.addEventListener("click", function() {
            copyToClipboard(this.getAttribute("data-code"));
        });
    });

    function copyToClipboard(text) {
        var tempInput = document.createElement('input');
        tempInput.style.position = 'absolute';
        tempInput.style.left = '-9999px';
        tempInput.value = text;
        document.body.appendChild(tempInput);

        tempInput.select();
        document.execCommand('copy');

        document.body.removeChild(tempInput);

        alert('Mã giảm giá đã được copy: ' + text);
    }
});
</script>

<?php
$css = <<<CSS
/* site.css */

.site-voucher .card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    width: 100%;
}

.site-voucher .card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.site-voucher .card-text {
    font-size: 1rem;
}

.site-voucher .btn-primary {
    background-color: #ff5722;
    border-color: #ff5722;
}

.site-voucher .btn-primary:hover {
    background-color: #e64a19;
    border-color: #e64a19;
}

.site-voucher .btn-outline-secondary {
    background-color: #ffffff;
    border-color: #dddddd;
    color: #333333;
}

.site-voucher .btn-outline-secondary:hover {
    background-color: #f0f0f0;
    border-color: #cccccc;
}

/* Center the content */
.site-voucher.container {
    padding: 20px;
}

.site-voucher .card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

CSS;
$this->registerCss($css);
?>
