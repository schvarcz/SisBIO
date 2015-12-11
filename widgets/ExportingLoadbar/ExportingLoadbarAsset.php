<?php

namespace app\widgets\ExportingLoadbar;

use yii\web\AssetBundle;

/**
 * Class ExportingLoadbarAsset
 *
 * @author Guiherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 *
 */
class ExportingLoadbarAsset extends AssetBundle
{

    public $sourcePath = '@app/widgets/ExportingLoadbar/assets';
    public $js = [
        'js/ExportingLoadbar.js'
    ];
    public $css = [
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
