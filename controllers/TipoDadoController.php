<?php

namespace app\controllers;

use app\models\TipoDado;
use app\models\TipoDadoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * TipoDadoController implements the CRUD actions for TipoDado model.
 */
class TipoDadoController extends Controller
{

    /**
     * Lists all TipoDado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoDadoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TipoDado model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idTipoDado)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idTipoDado),
        ]);
    }

    /**
     * Creates a new TipoDado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoDado;

        try
        {
            if ($model->load($_POST) && $model->save())
            {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost)
            {
                $model->load($_GET);
            }
        } catch (\Exception $e)
        {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing TipoDado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idTipoDado)
    {
        $model = $this->findModel($idTipoDado);

        if ($model->load($_POST) && $model->save())
        {
            return $this->redirect(Url::previous());
        } else
        {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TipoDado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idTipoDado)
    {
        $this->findModel($idTipoDado)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the TipoDado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoDado the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idTipoDado)
    {
        if (($model = TipoDado::findOne($idTipoDado)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
