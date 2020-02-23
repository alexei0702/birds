<?php

namespace app\models;

class CoordsImages extends \yii\db\ActiveRecord
{

	public function rules()
    {
        return [
            [['user_id', 'x', 'y', 'bird_name'], 'required'],
            [['image'],'default','value'=>""],
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg'], 'maxFiles' => 4],
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
        if($this->image !== null){
            $img = [];
            foreach ($this->image as $key => $value) {
                $img[] = time()."_".$value->baseName . '.' . $value->extension;
                $value->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/coordsImages/' .time()."_". $value->baseName . '.' . $value->extension);
            }
            $this->image = implode(';',$img);
            //$this->image->saveAs($_SERVER['DOCUMENT_ROOT'].'/basic/upload/coordsImages/' .time()."_". $this->image->baseName . '.' . $this->image->extension);
            //$this->image=time()."_".$this->image->baseName . '.' . $this->image->extension;
            /*chmod($_SERVER['DOCUMENT_ROOT'].'/basic/upload/' .time()."_". $this->link->baseName . '.' . $this->link->extension,0755);*/
        }
        return true;
        //} 
    // }   
    //     else {
    //         return false;
    //     }
        
    } 
}