<?php

namespace app\controllers;

use app\models\Familia;
use app\models\FamiliaSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * FamiliaController implements the CRUD actions for Familia model.
 */
class FamiliaController extends Controller
{

    /**
     * Lists all Familia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliaSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Familia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idFamilia)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idFamilia),
        ]);
    }

    /**
     * Creates a new Familia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Familia;

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
     * Updates an existing Familia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idFamilia)
    {
        $model = $this->findModel($idFamilia);

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
     * Deletes an existing Familia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idFamilia)
    {
        $this->findModel($idFamilia)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Familia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Familia the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idFamilia)
    {
        if (($model = Familia::findOne($idFamilia)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
