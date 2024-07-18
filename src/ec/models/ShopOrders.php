<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_orders".
 *
 * @property int $id
 * @property int $shop_id
 * @property int $order_id
 * @property string|null $payment
 * @property float $total
 * @property int $status
 *
 * @property Orders $order
 * @property Shop $shop
 * @property ShopOrderDetails[] $shopOrderDetails
 */
class ShopOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
            [['shop_id', 'order_id', 'status'], 'integer'],
            [['total'], 'number'],
            [['payment'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::class, 'targetAttribute' => ['shop_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Mã Shop',
            'order_id' => 'Mã đơn hàng',
            'payment' => 'Phương thức thanh toán',
            'total' => 'Tổng cộng',
            'status' => 'Trạng thái',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
    public function getShopOrderDetails()
    {
        return $this->hasMany(ShopOrderDetails::class, ['shop_order_id' => 'id']);
    }
    /**
     * Gets query for [[ShopOrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
   
}
