<?php

namespace app\models;

use Yii;
use yii\base\Model;


class StaticPage extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['title','content'], 'required'],
        ];
    }
}

?>