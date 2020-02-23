<?php

    namespace app\models\traits;

    trait Saving
    {
        public function saveOrThrow()
        {
            if(!$this->save()){
                throw new Exception($this->firstError);
            }
        }
    }