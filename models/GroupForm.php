<?php

namespace app\models;

use yii\base\Model;

class GroupForm extends Model
{
    public $groupby;


    public function rules()
    {
        return [
            ['groupby', 'string']
        ];
    }

    public function getGroupBy($groupby){
        return $groupby;
    }
}