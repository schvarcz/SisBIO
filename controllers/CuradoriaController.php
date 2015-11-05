<?php

/**
 * Description of Curadoria
 *
 * @author schvarcz
 */

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\Curadoria;

class CuradoriaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['adminCuradoria'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        if (isset($_POST["curadoria"]))   
        {
            Curadoria::deleteAll();
            foreach($_POST["curadoria"] as $curadoria)
            {
                $idTipoOrganismo = $curadoria["idTipoOrganismo"];
                if(isset($curadoria["curadores"]))
                {
                    foreach($curadoria["curadores"] as $idCurador)
                    {
                        $curador = new Curadoria;
                        $curador->idTipoOrganismo = $idTipoOrganismo;
                        $curador->idPesquisador = $idCurador;
                        $curador->save();
                    }
                }
            }
        }
        Url::remember();
        return $this->render('index');
    }
}
