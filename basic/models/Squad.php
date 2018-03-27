<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Squad extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['squad_name','squad_name_lat'], 'required'],
        ];
    }
}

?>