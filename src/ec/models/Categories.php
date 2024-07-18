<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $cate_name
 * @property int|null $p_id
 *
 * @property Categories[] $categories
 * @property Categories $p
 * @property Products[] $products
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_name'], 'required'],
            [['p_id'], 'integer'],
            [['cate_name'], 'string', 'max' => 255],
            [['p_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['p_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate_name' => 'Tên ngành hàng',
            'p_id' => 'Ngành hàng cha',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['p_id' => 'id']);
    }

    /**
     * Gets query for [[P]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Categories::class, ['id' => 'p_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['cate_id' => 'id']);
    }
    public function getParent()
    {
        return $this->hasOne(Categories::class, ['id' => 'parent_id']);
    }
    // Trong app\models\Categories.php
public static function getCategoriesList()
{
    return self::find()->select(['cate_name', 'id'])->indexBy('id')->column();
}

}
