<?php

namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class PostForm extends Model
{
    public $fullName;
    public $date;
    public $location;
    public $number;
    public $personGroup;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fullName', 'date', 'location', 'number', 'personGroup'], 'required'],
            ['number', 'unique', 'targetClass' => '\app\models\Person', 'message' => 'Такой номер уже существует'],
            ['number', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]*\s*$/'],
            ['personGroup', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fullName' => 'ФИО',
            'date' => 'Дата',
            'location' => 'Местонахождение',
            'number' => 'Номер',
            'personGroup' => 'Группа',
        ];
    }

    public function create()
    {
        $Person = new Person();
        $Number = new Number();
        $Person->fullName = $this->fullName;
        $Person->date = $this->date;
        $Person->location = $this->location;
        $Number->number = $this->number;
        $Person->personGroup = $this->personGroup + 1;
        $Person->save();
        $count = Person::find()->orderBy(['id' => SORT_DESC])->one();
        if(!empty($count)){
            $count = $count['id'];
        } else {
            $count = 1;
        }
        $Number->personId = $count;
        $Number->save();
    }
}