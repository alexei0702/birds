<?php

namespace app\models;

use app\models\traits\Saving;

class PopulationBirdPlace extends \yii\db\ActiveRecord
{
    use Saving;

	public function rules()
    {
        return [
            [['population_id','bird_id','place_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'population_id' => 'Численность',
            'bird_id' => 'Вид',
            'place_id' => 'Место'
        ];
    }
}