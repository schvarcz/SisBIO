<?php

namespace app\controllers;

use app\models\Ordem;
use app\models\OrdemSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * OrdemController implements the CRUD actions for Ordem model.
 */
class OrdemController extends Controller
{
	/**
	 * Lists all Ordem models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new OrdemSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Ordem model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idOrdem)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idOrdem),
		]);
	}

	/**
	 * Creates a new Ordem model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Ordem;

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
	 * Updates an existing Ordem model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idOrdem)
	{
		$model = $this->findModel($idOrdem);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Ordem model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idOrdem)
	{
		$this->findModel($idOrdem)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Ordem model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Ordem the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idOrdem)
	{
		if (($model = Ordem::findOne($idOrdem)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
