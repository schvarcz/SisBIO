<?php

namespace app\controllers;

use app\models\Filo;
use app\models\FiloSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * FiloController implements the CRUD actions for Filo model.
 */
class FiloController extends Controller
{

    /**
     * Lists all Filo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FiloSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Filo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idFilo)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idFilo),
        ]);
    }

    /**
     * Creates a new Filo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Filo;

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
     * Updates an existing Filo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idFilo)
    {
        $model = $this->findModel($idFilo);

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
     * Deletes an existing Filo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idFilo)
    {
        $this->findModel($idFilo)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Filo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Filo the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idFilo)
    {
        if (($model = Filo::findOne($idFilo)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
