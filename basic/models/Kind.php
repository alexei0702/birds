<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Kind extends \yii\db\ActiveRecord
{
public function rules()
    {
        return [
            [['kind_name','kind_name_lat'], 'required'],
        ];
    }
}

?>