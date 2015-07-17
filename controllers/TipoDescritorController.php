<?php

namespace app\controllers;

use app\models\TipoDescritor;
use app\models\TipoDescritorSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * TipoDescritorController implements the CRUD actions for TipoDescritor model.
 */
class TipoDescritorController extends Controller
{

    /**
     * Lists all TipoDescritor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoDescritorSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TipoDescritor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idTipoDescritor)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idTipoDescritor),
        ]);
    }

    /**
     * Creates a new TipoDescritor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoDescritor;

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
     * Updates an existing TipoDescritor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idTipoDescritor)
    {
        $model = $this->findModel($idTipoDescritor);

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
     * Deletes an existing TipoDescritor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idTipoDescritor)
    {
        $this->findModel($idTipoDescritor)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the TipoDescritor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoDescritor the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idTipoDescritor)
    {
        if (($model = TipoDescritor::findOne($idTipoDescritor)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
