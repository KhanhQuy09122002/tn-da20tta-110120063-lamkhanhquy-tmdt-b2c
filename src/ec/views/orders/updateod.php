<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Đơn hàng của tôi';
$this->params['breadcrumbs'][] = $this->title;

$status = Yii::$app->request->get('status', '');
?>

<div class="container">
    <h4 class="text-center"><?= Html::encode($this->title) ?></h4>

    <div class="row mb-4">
        <div class="col-md-3">
            <h5>Trạng thái đơn hàng</h5>
            <select class="form-control" onchange="window.location.href=this.value;">
                <option value="<?= Url::to(['updateod']) ?>" <?= $status === '' ? 'selected' : '' ?>>Tất cả đơn hàng</option>
                <option value="<?= Url::to(['updateod', 'status' => 1]) ?>" <?= $status === '1' ? 'selected' : '' ?>>Đơn chưa duyệt</option>
                <option value="<?= Url::to(['updateod', 'status' => 3]) ?>" <?= $status === '3' ? 'selected' : '' ?>>Đơn đã duyệt</option>
                <option value="<?= Url::to(['updateod', 'status' => 2]) ?>" <?= $status === '2' ? 'selected' : '' ?>>Đơn đã hủy</option>
            </select>
        </div>

        <div class="col-md-9">
            <div class="card mt-4">
                <div class="card-body">
                    <!-- Danh sách các đơn hàng -->
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Đơn hàng #<?= $order->id ?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0"><strong>Ngày đặt hàng:</strong> <?= $order->order_date ?></p>
                                    <p class="mb-0"><strong>Phương thức thanh toán:</strong>
                                        <?php
                                            if ($order->payment_method == 1) {
                                             echo "Thanh toán khi nhận hàng";
                                                } elseif ($order->payment_method == 2) {
                                                     echo "Thanh toán bằng tài khoản ngân hàng";
                                                        } else {
                                                           echo "Phương thức thanh toán không xác định";
                                                          }
                                                            ?>
                                    </p>

                                    <hr>
                                    <h6 class="mb-2">Chi tiết đơn hàng:</h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order->orderDetails as $detail): ?>
                                                <tr>
                                                    <td><?= $detail->product->product_name ?></td>
                                                    <td><?= $detail->quantity ?></td>
                                                    <td><?= number_format($detail->product->product_price, 0, ',', '.') ?> VND</td>
                                                    <td><?= number_format($detail->price, 0, ',', '.') ?> VND</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <hr>

                                    <?php if (!empty($order->orderDetails)): ?>
                                        <p class="mb-0"><strong>Tổng tiền thanh toán:</strong> <span style="color: red;"><?= number_format($order->total, 0, ',', '.') ?> đ</span></p>
                                    <?php else: ?>
                                        <p class="mb-0"><strong>Tổng tiền:</strong> 0 VND</p>
                                    <?php endif; ?>

                                    <p class="mb-0"><strong>Trạng thái:</strong>
                                        <?php
                                        switch ($order->status) {
                                            case 1:
                                                echo 'Chưa duyệt';
                                                break;
                                            case 2:
                                                echo 'Đã hủy';
                                                break;
                                            case 3:
                                                echo 'Đã duyệt';
                                                break;
                                            default:
                                                echo 'Không xác định';
                                        }
                                        ?>
                                    </p>

                                    <?php if ($order->status == 1): ?>
                                        <?= Html::a('Hủy Đơn', ['cancel-order', 'id' => $order->id], [
                                            'class' => 'btn btn-danger mt-2',
                                            'id' => 'cancelOrderBtn',
                                            'data-confirm' => 'Bạn có chắc chắn muốn hủy đơn hàng?',
                                        ]) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <br>
                        <?= LinkPager::widget([
                            'pagination' => $pagination,
                            'options' => ['class' => 'pagination justify-content-center'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                            'disabledListItemSubTagOptions' => ['class' => 'page-link disabled'],
                        ]) ?>
                    <?php else: ?>
                        <p class="text-center">Không có đơn hàng nào.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
