<?php

    namespace app\models\traits;

    trait Deleting
    {
        public function deleteOrThrow()
        {
            if(!$this->delete()){
                throw new Exception($this->firstError);
            }
        }
    }