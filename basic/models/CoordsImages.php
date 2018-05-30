<?php

namespace app\models;

use Yii;
use yii\base\Model;


class CoordsImages extends \yii\db\ActiveRecord
{

	public function rules()
    {
        return [
            [['user_id', 'x', 'y', 'bird_name'], 'required'],
            [['image'],'default','value'=>""],
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg']],
        ];
    }


    public function create()
    {
        // if ($this->validate()) {
            // if($this->image==null)
            // {
            //     return false;
            // }
            // else
            // {
                $this->image->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/coordsImages/' .time()."_". $this->image->baseName . '.' . $this->image->extension);
                $this->image=time()."_".$this->image->baseName . '.' . $this->image->extension;
                /*chmod($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension,0755);*/
                return true;
        //} 
    // }   
    //     else {
    //         return false;
    //     }
        
    } 
}

?>