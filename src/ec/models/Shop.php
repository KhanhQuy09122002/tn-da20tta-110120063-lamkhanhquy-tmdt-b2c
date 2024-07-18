<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property string $shop_name
 * @property string $logo_shop
 * @property string $des_shop
 * @property string $address_shop
 * @property string $email
 * @property string $phone
 * @property int $business_type
 * @property string $tax_id
 * @property int $sm_id
 * @property int $user_id
 * @property string $business_license
 * @property int $status
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['shop_name', 'des_shop', 'address_shop', 'email', 'phone', 'business_type', 'tax_id', 'sm_id'], 'required'],
            [['id', 'business_type', 'sm_id', 'user_id', 'status'], 'integer'],
            [['des_shop'], 'string'],
            [['shop_name', 'logo_shop', 'address_shop', 'email', 'business_license'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 13],
            [['tax_id'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['file'], 'file','extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_name' => 'Tên Shop',
            'logo_shop' => 'Logo Shop',
            'des_shop' => 'Mô tả Shop',
            'address_shop' => 'Địa chỉ đăng ký kinh doanh',
            'email' => 'Email doanh nghiệp',
            'phone' => 'Điện thoại doanh nghiệp',
            'business_type' => 'Loại hình kinh doanh',
            'tax_id' => 'Mã số thuế doanh nghiệp',
            'sm_id' => 'Phương thức vận chuyển',
            'user_id' => 'Mã người đại diện',
            'business_license' => 'Giấy phép kinh doanh',
            'status' => 'Trạng thái Shop',
        ];
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->status ='1';
            $this->user_id = Yii::$app->user->id;
            $this -> logo_shop ='/images/logoshop.png';
            $this -> business_license = '/images/gpkd.jpg';
        }
        return parent::beforeSave($insert);
    }
    public function getUser()
{
    return $this->hasOne(User::className(), ['user_id' => 'user_id']);
}
public function getProducts()
{
    return $this->hasmany(Products::className(), ['shop_id' => 'id']);
}



public function follow($userId)
{
    $follow = new Follow();
    $follow->user_id = $userId;
    $follow->shop_id = $this->id;
    return $follow->save();
}

public function unfollow($userId)
{
    $follow = Follow::findOne(['user_id' => $userId, 'shop_id' => $this->id]);
    if ($follow) {
        return $follow->delete();
    }
    return false;
}

public function isFollowing($userId)
{
    return Follow::find()->where(['user_id' => $userId, 'shop_id' => $this->id])->exists();
}

}
