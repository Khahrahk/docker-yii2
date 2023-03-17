<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $login;
    public $password;
    public $email;
    public $number;
    public $password_repeat;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password', 'email', 'number', 'password_repeat'], 'required'],
            // rememberMe must be a boolean value
            ['login', 'unique', 'targetClass'=>'\app\models\User', 'message'=>'Такой пользователь уже существует'],
            ['email', 'unique', 'targetClass'=>'\app\models\User', 'message'=>'Такой пользователь уже существует'],
            ['number', 'unique', 'targetClass'=>'\app\models\User', 'message'=>'Такой пользователь уже существует'],
            ['email', 'email'],
            ['number', 'number', 'min' => 10, 'max' => 10],
            ['login', 'match', 'pattern' => '/^[a-z]\w*$/i'],

            // password is validated by validatePassword()
            ['password', 'string', 'min'=>6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'email' => 'Email',
            'number' => 'Номер телефона',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }

    public function register(){
        if(!$this->validate()){
            return null;
        }
        $user = new User();

        $user->login = $this->login;
        $user->email = $this->email;
        $user->number = $this->number;
        $user->HashPassword($this->password);

        return $user->save() ? $user : null;
    }

}