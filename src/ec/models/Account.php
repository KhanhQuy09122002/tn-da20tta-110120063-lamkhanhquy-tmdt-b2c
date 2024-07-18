<?php

namespace app\models;

use Yii;
use app\components\Format;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username
 * @property string $password
* @property string $fullname

 * @property string $phone
 * @property int $role 0: admin - 1 : khách hàng- 2 : nhân viên - 3: quản lý
 * @property string $address
 * @property string $email
 * @property int $status 1: còn hoạt động- 0 : ko hoạt động
 *

 */
class Account extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ADMIN = 1;

    const KHACH = 4;
   
    /**
     * @inheritdoc
     */
    public $password_hash; 
    public static function tableName()
    {
        return 'users';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['role','status'], 'integer'],
            [['email','phone'], 'required'],
            [['username', 'address', 'email','password','fullname'], 'string'],
           // [['status'], 'string', 'max' => 15],
            [['phone'], 'string']
            
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           // 'id' => 'ID',
           'user_id' => 'User ID',
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
            'fullname' => 'Họ tên',
           
            'phone' => 'Điện thoại',
            'role' => 'Phân quyền',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'status' => 'Trạng thái',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function beforeSaveUser($post){
        
        $this->username = ($post['username']) ? $post['username'] : '';
        $this->password = ($post['password']) ? $post['password'] : '';
        $this->fullname = ($post['fullname']) ? $post['fullname'] : '';
  
        $this->phone = ($post['phone']) ? $post['phone'] : '';
        $this->role = ($post['role']) ? $post['role'] : '1';
        $this->address = ($post['address']) ? $post['address'] : '';
        $this->email = ($post['email']) ? $post['email'] : '';
    }
   
    public function validatePassword($password){
         return ($this->password ==$password)? true : false; //
    }
     //Giữ
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    //Giữ
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
    public function getId()
    {
        return $this->user_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

//Cần thiết
    public function idLogged(){
        if(isset($_SESSION['ID_USER'])){
            return $_SESSION['ID_USER'];
        }
        return false;
    }
    
   

   
    
}

