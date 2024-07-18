<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_date
 * @property float $total
 * @property int $payment_method
 * @property int $status
 *
 * @property OrderDetail[] $orderDetails
 * @property Users $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['user_id', 'order_date', 'total', 'payment_method'], 'required'],
            [['user_id', 'status','payment_method'], 'integer'],
            [['order_date'], 'safe'],
            [['total'], 'number'],
          
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Người dùng',
            'order_date' => 'Ngày tạo',
            'total' => 'Tổng tiền',
            'payment_method' => 'Phương thức thanh toán',
            'status' => 'Trạng thái',
        ];
    }

    /**
     * Gets query for [[OrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['user_id' => 'user_id']);
    }
}
