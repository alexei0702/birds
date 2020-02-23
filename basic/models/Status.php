<?php

namespace app\models;

class Status extends \yii\db\ActiveRecord
{
    public static function getTitle () {
        return 'Статусы';
    }

    public static function tableName()
    {
        return 'statuses';
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