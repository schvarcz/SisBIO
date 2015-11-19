<?php

namespace app\controllers;

use app\models\Exportacao;
use app\models\ExportacaoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;

/**
 * ExportacaoController implements the CRUD actions for Exportacao model.
 */
class ExportacaoController extends Controller
{

    /**
     * Lists all Exportacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = ExportacaoSearch::defaultSearch();

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Exportacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $searchModel = new ExportacaoSearch();
        $dataProvider = $searchModel->search($_GET);

        if (isset($_GET["export"]))
        {
            $export = new Exportacao();
            if ($export->load([
                    "Exportacao"=>[
                        "sql" => $_SERVER['QUERY_STRING'],
                        "idPesquisador" => \Yii::$app->user->id
                    ]
            ]) && $export->save())
            {
                return $this->redirect(Url::toRoute("index"));
            }
            print_r($export);
            exit();
        }
        
        return $this->render('create', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    /**
     * Deletes an existing Exportacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idExportacao)
    {
        $this->findModel($idExportacao)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Exportacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exportacao the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idexportacoes)
    {
        if (($model = Exportacao::findOne($idexportacoes)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
