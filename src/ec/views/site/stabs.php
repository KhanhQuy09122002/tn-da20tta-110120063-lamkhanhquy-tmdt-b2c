<?php

use yii\helpers\Html;

$this->title = 'Thống kê';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-statistics">
    <div class="section">
        <h4>Sản phẩm sắp hết hàng</h4>
        <div class="content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lowStockProducts as $product): ?>
                            <tr>
                                <td><?= Html::encode($product->product_name) ?></td>
                                <td>Còn <?= Html::encode($product->product_quantity) ?> sản phẩm</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="section">
        <h4>Doanh thu của shop</h4>
        <div class="content">
            <p><?= number_format($shopRevenue, 2) ?> VNĐ</p>
        </div>
    </div>
</div>
<style>
    .site-statistics {
        margin: 20px;
        max-width: 100%; /* Điều chỉnh độ rộng tối đa của site-statistics */
        overflow-x: auto; /* Cho phép cuộn ngang nếu cần */
    }

    .section {
        border: 1px solid #ccc;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%; /* Điều chỉnh độ rộng của các section */
        box-sizing: border-box; /* Đảm bảo tính chính xác của độ rộng */
    }

    .section h2 {
        margin-bottom: 10px;
    }

    .content {
        padding-left: 20px;
    }

    /* Responsive table */
    .table-responsive {
        overflow-x: auto;
        max-width: 100%; /* Giới hạn độ rộng tối đa của bảng */
    }
</style>

