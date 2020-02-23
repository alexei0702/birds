<?php

namespace app\models;

use app\models\traits\Saving;

class StatusBird extends \yii\db\ActiveRecord
{
    use Saving;

	public function rules()
    {
        return [
            [['status_id','bird_id'], 'required'],
        ];
    }

    public function saveAll($id) {
        foreach ($this->status_id as $status)
        {
            $model = new StatusBird();
            $model->bird_id = $id;
            $model->status_id = $status;
            $model->saveOrThrow();
        }
    }

    public function attributeLabels()
    {
        return [
            'status_id' => 'Статус'
        ];
    }
}