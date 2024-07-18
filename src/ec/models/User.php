<?php

namespace app\models;
use Yii;
class User extends Users implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;

    public static function findIdentity($id)
    {
        return User ::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return true;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User ::findOne(['username'=> $username]);
       
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    public function idLogged(){
        if(isset($_SESSION['ID_USER'])){
            return $_SESSION['ID_USER'];
        }
        return false;
    }
  
}

