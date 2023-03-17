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
        $count = Groups::find()->orderBy(['id' => SORT_DESC])->one();
        $count = $count['id'] + 1;
        $Group = new Groups();
        $Group->id = $count;
        $Group->name = $this->name;
        return $Group->save() ? $Group : null;
    }
}