<?php

namespace app\controllers;

use app\models\Coleta;
use app\models\ColetaSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * ColetaController implements the CRUD actions for Coleta model.
 */
class ColetaController extends Controller
{
	/**
	 * Lists all Coleta models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ColetaSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Coleta model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idColeta)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idColeta),
		]);
	}

	/**
	 * Creates a new Coleta model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Coleta;

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
	 * Updates an existing Coleta model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idColeta)
	{
		$model = $this->findModel($idColeta);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Coleta model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idColeta)
	{
		$this->findModel($idColeta)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Coleta model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Coleta the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idColeta)
	{
		if (($model = Coleta::findOne($idColeta)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
