<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string login
 * @property string email
 * @property string number
 * @property string password
 * @property string authKey
 * @property string isAdmin
 * @property string accessToken
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName(){
        return 'users';
    }

    private static $users;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $login
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAdmin()
    {
        return $this->isAdmin;
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
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function HashPassword($password){
        $this->password=Yii::$app->security->generatePasswordHash($password);
    }
}
