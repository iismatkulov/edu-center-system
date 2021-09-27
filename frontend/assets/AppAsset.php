<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css'
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js',
        'js/main.js',
        'http://code.jquery.com/jquery-1.11.0.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/i18n/datepicker.ru-RU.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
