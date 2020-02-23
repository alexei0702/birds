<?php

namespace app\models;

class Family extends \yii\db\ActiveRecord
{

    public static function getTitle () {
        return 'Семейства';
    }

    public function rules() {
        return [
            [['name','name_lat'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'name_lat' => 'Название на латыни'
        ];
    }
}