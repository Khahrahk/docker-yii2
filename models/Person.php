<?php

namespace app\models;

use yii\db\ActiveRecord;


class Person extends ActiveRecord
{

    /**
     * @var mixed|null
     */

    public static function tableName()
    {
        return 'person';
    }

    public function getNumber()
    {
        return $this->hasMany(Number::className(), ['personId' => 'id']);
    }

    public function getGroups()
    {
        return $this->hasOne(Groups::className(), ['id' => 'personGroup']);
    }
}