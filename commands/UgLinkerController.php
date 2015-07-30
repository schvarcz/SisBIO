<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

class UgLinkerController extends Controller
{

    public function actionIndex()
    {
        $this->linkUAP();
        $this->linkUAL();
    }

    public function linkUAP()
    {
        $uaps = \app\models\base\UnidadeGeografica::find()->where(["like","Nome", "UAP"])->andWhere(["regexp","Nome", "^[0-9]+"])->all();
        foreach($uaps as $uap)
        {
            $idUAR = explode(" ",str_replace("_", " ", $uap->getLabel()))[0];
            echo $idUAR."\n";
            
            $uar = \app\models\base\UnidadeGeografica::find()->where(["like","Nome", "UAR ".$idUAR." "])->orWhere(["like","Nome", "UAR ".$idUAR."a "])->one();
            $uap->link("idUnidadeGeograficaPai0", $uar);
            echo $uar->getLabel()."\n";
            echo "\n";
        }
    }
    public function linkUAL()
    {
        $uals = \app\models\base\UnidadeGeografica::find()->where(["like","Nome", "UAL"])->andWhere(["regexp","Nome", "^[0-9]+"])->all();
        foreach($uals as $ual)
        {
            $idUAP = explode(" ",str_replace("_", " ", $ual->getLabel()))[0];
            echo $ual->getLabel()." - ".$idUAP."\n";
            
            $uap = \app\models\base\UnidadeGeografica::find()->where(["like","Nome", "UAP"])->andWhere(["regexp","Nome", "^$idUAP+"])->one();
            $ual->link("idUnidadeGeograficaPai0", $uap);
            echo $uap->getLabel()."\n";
            echo "\n";
        }
    }
}
