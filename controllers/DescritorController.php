<?php

namespace app\controllers;

use app\models\Descritor;
use app\models\DescritorSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * DescritorController implements the CRUD actions for Descritor model.
 */
class DescritorController extends Controller
{
	/**
	 * Lists all Descritor models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new DescritorSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Descritor model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idDescritor)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idDescritor),
		]);
	}

	/**
	 * Creates a new Descritor model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Descritor;

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
	 * Updates an existing Descritor model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idDescritor)
	{
		$model = $this->findModel($idDescritor);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Descritor model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idDescritor)
	{
		$this->findModel($idDescritor)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Descritor model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Descritor the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idDescritor)
	{
		if (($model = Descritor::findOne($idDescritor)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
