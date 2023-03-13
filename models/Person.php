<?php

namespace app\models;

use yii\db\ActiveRecord;


class Person extends ActiveRecord{

    public static function tableName()
    {
        return 'person';
    }
    public function getNumber()
    {
        return $this->hasMany(Number::className(), ['PersonId' => 'id']);
    }
}