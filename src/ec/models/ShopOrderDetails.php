<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_order_details".
 *
 * @property int $id
 * @property int $shop_order_id
 * @property string $product_name
 * @property int $quantity
 * @property float $price
 *
 * @property ShopOrders $shopOrder
 */
class ShopOrderDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_order_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          
            [['shop_order_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['product_name'], 'string', 'max' => 255],
            [['shop_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopOrders::class, 'targetAttribute' => ['shop_order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_order_id' => 'Mã đơn hàng Shop',
            'product_name' => 'Tên sản phẩm',
            'quantity' => 'Số lượng',
            'price' => 'Tổng cộng',
        ];
    }

    /**
     * Gets query for [[ShopOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShopOrder()
    {
        return $this->hasOne(ShopOrders::class, ['id' => 'shop_order_id']);
    }
}
