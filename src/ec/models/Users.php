<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property int $username
 * @property int $password
 * @property int $fullname
 * @property int $email
 * @property int $address
 * @property int $phone
 * @property int $role
 * @property int $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'password', 'fullname', 'email', 'address','phone', 'role', 'status'], 'required'],
            [['user_id','phone', 'role', 'status'], 'integer'],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'address'=>'Địa chỉ',
            'phone' => 'Phone',
            'role' => 'Role',
            'status' => 'Status',
        ];
    }
    public function getShop()
    {
        return $this->hasMany(Shop::class, ['user_id' => 'user_id']);
    }
}
