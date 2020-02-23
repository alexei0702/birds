<?php

namespace app\models;

class Place extends \yii\db\ActiveRecord
{
    public static function getTitle () {
        return 'Места';
    }

    public static function tableName()
    {
        return 'places';
    }

	public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название'
        ];
    }
}