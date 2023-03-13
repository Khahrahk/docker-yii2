<?php

namespace app\models;

use yii\db\ActiveRecord;

class Number extends ActiveRecord{

    public static function tableName()
    {
        return 'number';
    }

}