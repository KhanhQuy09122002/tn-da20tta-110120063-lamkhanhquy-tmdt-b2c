<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */

$this->title = $model->shop_name;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
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
                    <img src="<?= Html::encode($model->logo_shop) ?>" alt="Logo Shop" class="img-fluid mb-3" style="max-width: 150px;">
                </div>
                <div class="col-md-9">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Tên Shop</th>
                                <td><?= Html::encode($model->shop_name) ?></td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td><?= Html::encode($model->des_shop) ?></td>
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
                                    <img src="<?= Html::encode($model->business_license) ?>" alt="Giấy phép kinh doanh" class="img-fluid" style="max-width: 150px; cursor: pointer;" data-toggle="modal" data-target="#businessLicenseModal">
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
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="businessLicenseModal" tabindex="-1" aria-labelledby="businessLicenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="businessLicenseModalLabel">Giấy phép kinh doanh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="<?= Html::encode($model->business_license) ?>" alt="Giấy phép kinh doanh" class="img-fluid">
            </div>
        </div>
    </div>
</div>