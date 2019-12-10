<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Coords extends \yii\db\ActiveRecord
{

public function rules()
    {
        return [
            [['lat','lng','bird_id', 'polygon_number'], 'required'],
        ];
    }
}

?>