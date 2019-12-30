<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Kind;
use app\models\Squad;
use app\models\Family;
use app\models\Population;
use app\models\Status;
use app\models\Coords;

class Bird extends \yii\db\ActiveRecord
{
    // region: 1 - юг Восточной Сибири, 2 - Республика Тыва
	public function rules()
    {
        return [
            [['bird_name','bird_name_lat', 'family_id','squad_id','kind_id', 'propagation', 'migration', 'habitat', 'region'], 'required'],
            [['link'],'default','value'=>""],
            [['link', 'area'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg']],
        ];
    }


    public function create()
    {
        if ($this->validate()) {
            if($this->area != null){
                $this->area->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/area/' .time()."_". $this->area->baseName . '.' . $this->area->extension);
                $this->area=time()."_".$this->area->baseName . '.' . $this->area->extension;
            }
            if($this->link==null)
            {
                $this->link = "noimage.png";
                return true;
            }
            else
            {
                $this->link->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension);
                $this->link=time()."_".$this->link->baseName . '.' . $this->link->extension;
                /*chmod($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension,0755);*/
                return true;
            } 
        }   
        else {
            return false;
        }
    }  

    public function updateBird()
    {
        if ($this->validate()) {
            if(!is_string($this->area) && $this->area != null){
                $this->area->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/area/' .time()."_". $this->area->baseName . '.' . $this->area->extension);
                $this->area=time()."_".$this->area->baseName . '.' . $this->area->extension;
            }
            if(is_string($this->link)){
                return true;
            }
            else{
                $this->link->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension);
                $this->link=time()."_".$this->link->baseName . '.' . $this->link->extension;
                /*chmod($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension,0755);*/
                return true;
            }
        } else {
            return false;
        }
    }   

    public function getKind()
    {
        return $this->hasOne(Kind::className(), ['kind_id' => 'kind_id']);
    }

    public function getFamily()
    {
        return $this->hasOne(Family::className(), ['family_id' => 'family_id']);
    }

    public function getSquad()
    {
        return $this->hasOne(Squad::className(), ['squad_id' => 'squad_id']);
    }

    public function getPopulation()
    {
        return $this->hasMany(Population::className(), ['population_id' => 'population_id'])
            ->viaTable('population_connect', ['bird_id' => 'bird_id']);
    }

    public function getStatuses()
    {
        return $this->hasMany(Status::className(), ['status_id' => 'status_id'])
            ->viaTable('status_connect', ['bird_id' => 'bird_id']);
    }

    public function getCoords()
    {
        return $this->hasMany(Coords::className(), ['bird_id' => 'bird_id']);
    }

}

?>