<?php
    /**
     * @link http://www.yiiframework.com/
     * @copyright Copyright (c) 2008 Yii Software LLC
     * @license http://www.yiiframework.com/license/
     */

    namespace app\assets;

    use yii\web\AssetBundle;

    /**
     * @author Qiang Xue <qiang.xue@gmail.com>
     * @since 2.0
     */
    class AdminAsset extends AssetBundle
    {
        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'css/sweetalert2.min.css',
//            Custom fonts for this template
            'css/fontawesome-free/css/all.min.css',
            'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
//            Custom styles for this template
            'css/sb-admin-2.min.css'
        ];
        public $js = [
            'https://cdn.jsdelivr.net/npm/sweetalert2@9',
//            Bootstrap core JavaScript
//            'js/vendor/jquery/jquery.min.js',
            'js/vendor/bootstrap/js/bootstrap.bundle.min.js',
//            Core plugin JavaScript
            'js/vendor/jquery-easing/jquery.easing.min.js',
//            Custom scripts for all pages
            'js/sb-admin-2.min.js',
//            Page level plugins
            'js/vendor/datatables/jquery.dataTables.min.js',
            'js/vendor/datatables/dataTables.bootstrap4.min.js',
//            Page level custom scripts
            'js/datatables.js'
        ];
        public $depends = [
            'yii\web\YiiAsset',
        ];
        public $jsOptions = [
//            'defer' => 'defer'
        ];
    }
