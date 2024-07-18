<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property int $id
 * @property string $voucher_code
 * @property string|null $description
 * @property int|null $usage_limit
 * @property float $discount_percentage
 * @property float|null $min_order_amount
 * @property string $start_date
 * @property string $end_date

 * @property int|null $used_count
 * @property int $status
 *

 */
class Voucher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voucher_code', 'discount_percentage', 'start_date', 'end_date', 'status'], 'required'],
            [['description'], 'string'],
            [['usage_limit', 'used_count', 'status'], 'integer'],
            [['discount_percentage', 'min_order_amount'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['voucher_code'], 'string', 'max' => 255],
            [['voucher_code'], 'unique'],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'voucher_code' => 'Voucher Code',
            'description' => 'Description',
            'usage_limit' => 'Usage Limit',
            'discount_percentage' => 'Discount Percentage',
            'min_order_amount' => 'Min Order Amount',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
          
            'used_count' => 'Used Count',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
   

    public function applyDiscount($total)
{
    // Tính toán giảm giá
    $discountedTotal = $total * (1 - $this->discount_percentage / 100);
    
    // Làm tròn và trả về giá trị giảm giá
    return round($discountedTotal);
}

}
