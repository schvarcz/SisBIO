<?php

namespace app\controllers;

use app\models\Exportacao;
use app\models\ExportacaoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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

        return $this->render('create', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
        
//        $model = new Exportacao;
//
//        try
//        {
//            if ($model->load($_POST) && $model->save())
//            {
//                return $this->redirect(Url::previous());
//            } elseif (!\Yii::$app->request->isPost)
//            {
//                $model->load($_GET);
//            }
//        } catch (\Exception $e)
//        {
//            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
//            $model->addError('_exception', $msg);
//        }
//        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Deletes an existing Exportacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idexportacoes)
    {
        $this->findModel($idexportacoes)->delete();
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
