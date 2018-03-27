<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Status extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['status_name'], 'required'],
        ];
    }
}

?>