<?php

namespace app\models;

class Kind extends \yii\db\ActiveRecord
{
    public static function getTitle () {
        return 'Рода';
    }

    public function rules()
    {
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