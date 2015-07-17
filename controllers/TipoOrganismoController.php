<?php

namespace app\controllers;

use app\models\TipoOrganismo;
use app\models\TipoOrganismoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * TipoOrganismoController implements the CRUD actions for TipoOrganismo model.
 */
class TipoOrganismoController extends Controller
{

    /**
     * Lists all TipoOrganismo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoOrganismoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TipoOrganismo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idTipoOrganismo)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idTipoOrganismo),
        ]);
    }

    /**
     * Creates a new TipoOrganismo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoOrganismo;
        try
        {
            if ($model->saveWithRelated($_POST))
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
     * Updates an existing TipoOrganismo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idTipoOrganismo)
    {
        $model = $this->findModel($idTipoOrganismo);

        if ($model->saveWithRelated($_POST))
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
     * Deletes an existing TipoOrganismo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idTipoOrganismo)
    {
        $this->findModel($idTipoOrganismo)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the TipoOrganismo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoOrganismo the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idTipoOrganismo)
    {
        if (($model = TipoOrganismo::findOne($idTipoOrganismo)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
