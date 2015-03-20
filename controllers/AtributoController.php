<?php

namespace app\controllers;

use app\models\Atributo;
use app\models\AtributoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * AtributoController implements the CRUD actions for Atributo model.
 */
class AtributoController extends Controller
{
	/**
	 * Lists all Atributo models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new AtributoSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Atributo model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idAtributo)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idAtributo),
		]);
	}

	/**
	 * Creates a new Atributo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Atributo;

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
		}
        return $this->render('create', ['model' => $model,]);
	}

	/**
	 * Updates an existing Atributo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idAtributo)
	{
		$model = $this->findModel($idAtributo);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Atributo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idAtributo)
	{
		$this->findModel($idAtributo)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Atributo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Atributo the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idAtributo)
	{
		if (($model = Atributo::findOne($idAtributo)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
