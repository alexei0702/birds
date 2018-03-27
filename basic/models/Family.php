<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Family extends \yii\db\ActiveRecord
{

public function rules()
    {
        return [
            [['family_name','family_name_lat'], 'required'],
        ];
    }
}

?>