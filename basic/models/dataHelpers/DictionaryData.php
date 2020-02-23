<?php

    namespace app\models\dataHelpers;

    use app\models\Family;
    use app\models\Kind;
    use app\models\Place;
    use app\models\Population;
    use app\models\Squad;
    use app\models\Status;

    class DictionaryData
    {
        public static function getBirdDictionary() {
            return [
                'squads' => Squad::find()->orderBy('name')->all(),
                'families' => Family::find()->orderBy('name')->all(),
                'kinds' => Kind::find()->orderBy('name')->all(),
                'statuses' => Status::find()->orderBy('name')->all(),
                'populations' => Population::find()->all(),
                'places' => Place::find()->orderBy('name')->all()
            ];
        }
    }