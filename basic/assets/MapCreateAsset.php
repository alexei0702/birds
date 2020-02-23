<?php
    /**
     * @link http://www.yiiframework.com/
     * @copyright Copyright (c) 2008 Yii Software LLC
     * @license http://www.yiiframework.com/license/
     */

    namespace app\assets;

    /**
     * @author Qiang Xue <qiang.xue@gmail.com>
     * @since 2.0
     */
    class MapCreateAsset extends AdminAsset
    {
        public $js = [
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyD3jZ1PHeLxCwShhwrvsC_rIvE3LfF-Es8',
            'js/map-create.js'
        ];
    }
