<?php

namespace app\models;

use Yii;
use yii\base\Model;


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

}

?>