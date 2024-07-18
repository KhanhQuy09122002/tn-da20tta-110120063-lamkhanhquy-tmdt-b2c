<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_attributes".
 *
 * @property int $id
 * @property string $name
 * @property int|null $product_id
 *
 * @property Products $product
 * @property ProductAttributeValues[] $productAttributeValues
 */
class ProductAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['product_id' => 'product_id']);
    }

    /**
     * Gets query for [[ProductAttributeValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributeValues()
    {
        return $this->hasMany(ProductAttributeValues::class, ['attribute_id' => 'id']);
    }
}
