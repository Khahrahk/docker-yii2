<?php

namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class GroupForm extends Model
{
    public $name;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
        ];
    }

    public function create()
    {
        $Group = new Groups();
        $Group->name = $this->name;
        return $Group->save() ? $Group : null;
    }
}