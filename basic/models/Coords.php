<?php

namespace app\models;

use app\models\traits\Saving;

class Coords extends \yii\db\ActiveRecord
{
    use Saving;

    public function rules()
    {
        return [
            [['lat','lng','bird_id', 'polygon_number'], 'required'],
        ];
    }

    public static function saveCoords($path, $id) {
        $poly_num = 0;

        foreach ($path as $poly_path) {
            foreach ($poly_path as $coords) {
                $model = new Coords();
                $model->bird_id = $id;
                $model->lat = $coords->lat;
                $model->lng = $coords->lng;
                $model->polygon_number = $poly_num;
                $model->saveOrThrow();
            }
            $poly_num++;
        }
    }
}