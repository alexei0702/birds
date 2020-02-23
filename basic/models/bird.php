<?php

namespace app\models;

use app\models\Population;
use app\models\traits\Deleting;
use app\models\traits\Saving;
use Yii;
use yii\base\Model;
use app\models\Kind;
use app\models\Squad;
use app\models\Family;
use app\models\Status;
use app\models\Coords;
use app\models\Place;
use yii\db\Exception;

class Bird extends \yii\db\ActiveRecord
{
    use Saving;
    use Deleting;

    const DEFAULT_IMAGE = 'no-image.png';
    const AREA_PATH = '/area/';
    const IMAGE_PATH = '/';

    public static function tableName()
    {
        return 'birds';
    }
    // TODO: add const
    // region: 1 - юг Восточной Сибири, 2 - Республика Тыва
	public function rules()
    {
        return [
            [['name','name_lat', 'family_id','squad_id','kind_id', 'propagation', 'migration', 'habitat', 'region'], 'required'],
            [['link'], 'default', 'value' => self::DEFAULT_IMAGE],
            [['link', 'area'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
        ];
    }

    public function saveFiles()
    {
        if ($this->validate()) {
            $success = true;

            // Сохранение картинки с ареалом
            if($this->area !== null && !is_string($this->area))
                if (!($this->area = $this->saveFile($this->area, self::AREA_PATH)))
                    $success = false;
            else
                $this->area = $this->getOldAttribute('area');
            // Сохранение главной картинки
            if($this->link !== null && !is_string($this->link)) {
                $this->link = $this->saveFile($this->link, self::IMAGE_PATH);
                if (!$this->link)
                    $success = false;
            }
            else
                $this->link = $this->getOldAttribute('link');

            if ($success)
                return true;
        }

        return false;
    }

    private function saveFile ($file, $path) {
        $filename = time()."_".$file->baseName . '.' . $file->extension;
        if ($file->saveAs(\Yii::$app->basePath . Yii::getAlias('@img') . $path . $filename))
            return $filename;
        return false;
    }

    public function deleteFiles() {
        if ($this->link !== self::DEFAULT_IMAGE)
            if (!unlink(\Yii::$app->basePath . Yii::getAlias('@img') . self::IMAGE_PATH . $this->link))
                throw new Exception($this->firstErrors);

        if ($this->area !== null)
            if (!unlink(\Yii::$app->basePath . Yii::getAlias('@img') . self::AREA_PATH . $this->area))
                throw new Exception($this->firstErrors);
    }

    public function getKind()
    {
        return $this->hasOne(Kind::className(), ['id' => 'kind_id']);
    }

    public function getFamily()
    {
        return $this->hasOne(Family::className(), ['id' => 'family_id']);
    }

    public function getSquad()
    {
        return $this->hasOne(Squad::className(), ['id' => 'squad_id']);
    }

    public function getPopulation()
    {
        return $this->hasMany(Population::className(), ['id' => 'population_id'])
            ->viaTable('population_bird_place', ['bird_id' => 'id']);
    }

    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['id' => 'place_id'])
            ->viaTable('population_bird_place', ['bird_id' => 'id']);
    }

    public function getStatuses()
    {
        return $this->hasMany(Status::className(), ['id' => 'status_id'])
            ->viaTable('status_bird', ['bird_id' => 'id']);
    }

    public function getCoords()
    {
        return $this->hasMany(Coords::className(), ['bird_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'name_lat' => 'Название на латыни',
            'family_id' => 'Семейство',
            'squad_id' => 'Отряд',
            'kind_id' => 'Род',
            'propagation' => 'Распространение',
            'migration' => 'Миграции',
            'habitat' => 'Место обитания',
            'region' => 'Регион'
        ];
    }
}