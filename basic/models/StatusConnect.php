<?php

namespace app\models;

use Yii;
use yii\base\Model;


class StatusConnect extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['status_id','bird_id'], 'required'],
        ];
    }
}
?>