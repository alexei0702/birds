<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Population extends \yii\db\ActiveRecord
{
	public function rules()
	    {
	        return [
	            [['population_designations','population','population_description','population_dimension_start','population_dimension_end'], 'required'],
	        ];
	    }
}

?>