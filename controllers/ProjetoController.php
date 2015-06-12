<?php

namespace app\controllers;

use app\models\Projeto;
use app\models\ProjetoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * ProjetoController implements the CRUD actions for Projeto model.
 */
class ProjetoController extends Controller {

    /**
     * Lists all Projeto models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProjetoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Projeto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idProjeto) {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idProjeto),
        ]);
    }

    /**
     * Creates a new Projeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Projeto;

        try {
            if ($model->saveWithRelated($_POST)) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model,]);
    }

    /**
     * Updates an existing Projeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idProjeto) {
        $model = $this->findModel($idProjeto);

        if ($model->saveWithRelated($_POST)) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idProjeto) {
        $this->findModel($idProjeto)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Projeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projeto the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idProjeto) {
        if (($model = Projeto::findOne($idProjeto)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
