<?php

namespace app\controllers;

use app\models\TipoAtributo;
use app\models\TipoAtributoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * TipoAtributoController implements the CRUD actions for TipoAtributo model.
 */
class TipoAtributoController extends Controller
{
	/**
	 * Lists all TipoAtributo models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new TipoAtributoSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single TipoAtributo model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idTipoAtributo)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idTipoAtributo),
		]);
	}

	/**
	 * Creates a new TipoAtributo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new TipoAtributo;

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
	 * Updates an existing TipoAtributo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idTipoAtributo)
	{
		$model = $this->findModel($idTipoAtributo);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing TipoAtributo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idTipoAtributo)
	{
		$this->findModel($idTipoAtributo)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the TipoAtributo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return TipoAtributo the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idTipoAtributo)
	{
		if (($model = TipoAtributo::findOne($idTipoAtributo)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
