<?php

namespace app\models;

use yii\db\ActiveRecord;

class Groups extends ActiveRecord
{

    public static function tableName()
    {
        return 'groups';
    }
}