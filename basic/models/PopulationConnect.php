<?php

namespace app\models;

use Yii;
use yii\base\Model;


class PopulationConnect extends \yii\db\ActiveRecord
{
	public function rules()
    {
        return [
            [['population_id','bird_id','place_id'], 'required'],
        ];
    }
}

?>