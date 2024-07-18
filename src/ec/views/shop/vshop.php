<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */

$this->title = $model->shop_name;

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shop-view container-fluid">

    <h4 class="mb-4"><?= Html::encode($this->title) ?></h4>

    <div class="card mb-3">
        <div class="card-header">
            Thông tin Shop
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="<?= $model->logo_shop ?>" alt="Logo Shop" class="img-fluid rounded-circle mb-3 logo-shop">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Tên Shop</th>
                                        <td><?= Html::encode($model->shop_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td><?= Html::encode($model->address_shop) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= Html::encode($model->email) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Điện thoại</th>
                                        <td><?= Html::encode($model->phone) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Loại hình kinh doanh</th>
                                        <td>
                                            <?php
                                            $types = [
                                                1 => 'Cá nhân',
                                                2 => 'Tổ chức',
                                                3 => 'Doanh nghiệp',
                                            ];
                                            echo isset($types[$model->business_type]) ? $types[$model->business_type] : 'Không xác định';
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Mã số thuế</th>
                                        <td><?= Html::encode($model->tax_id) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phương thức vận chuyển</th>
                                        <td>
                                            <?php
                                            $shippingMethods = [
                                                1 => 'Giao hàng nhanh',
                                                2 => 'Giao hàng tiết kiệm',
                                                3 => 'Nhận tại cửa hàng',
                                            ];
                                            echo isset($shippingMethods[$model->sm_id]) ? $shippingMethods[$model->sm_id] : 'Không xác định';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Người đại diện</th>
                                        <td><?= isset($model->user) ? Html::encode($model->user->fullname) : 'Không xác định' ?></td>

                                    </tr>
                                    <tr>
                                        <th>Giấy phép kinh doanh</th>
                                        <td>
                                            <img src="<?= $model->business_license ?>" alt="Giấy phép kinh doanh" class="img-fluid" style="max-width: 150px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái Shop</th>
                                        <td>
                                            <?php
                                            $statuses = [
                                                1 => 'Chưa duyệt',
                                                2 => 'Đã duyệt',
                                                3 => 'Tạm ngưng hoạt động',
                                            ];
                                            echo isset($statuses[$model->status]) ? $statuses[$model->status] : 'Không xác định';
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Mô tả</th>
                                        <td><?= Html::encode($model->des_shop) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p>
    <?= Html::a('Cập nhật', ['shop/updt', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>


    </p>
</div>

<?php
$css = <<<CSS
.logo-shop {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #f8f9fa; /* Đường viền xung quanh logo */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
}
CSS;
$this->registerCss($css);
?>