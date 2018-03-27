<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Place extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['place_name'], 'required'],
        ];
    }

}

?>