<?php

namespace app\models;

class Population extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'populations';
    }

	public function rules()
	    {
	        return [
	            [['designations','population','description','dimension_start','dimension_end'], 'required'],
	        ];
	    }
}