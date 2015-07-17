<?php

namespace app\widgets\GMaps;

use yii\web\AssetBundle;

/**
 * Class GMapsAsset
 *
 * @author Guiherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 *
 */
class GMapsAsset extends AssetBundle
{

    public $sourcePath = '@app/widgets/GMaps/assets';
    public $js = [
        'https://maps.googleapis.com/maps/api/js?v=3.exp',
        'js/GMaps.js'
    ];
    public $css = [
        'css/GMaps.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
