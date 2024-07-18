<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_attribute_values".
 *
 * @property int $id
 * @property string $value
 * @property int $attribute_id
 *
 * @property ProductAttributes $attribute0
 */
class ProductAttributeValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attribute_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'attribute_id'], 'required'],
            [['attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 50],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAttributes::class, 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'attribute_id' => 'Attribute ID',
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(ProductAttributes::class, ['id' => 'attribute_id']);
    }
}
