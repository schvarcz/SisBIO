<?php

namespace app\controllers;

use app\models\Especie;
use app\models\EspecieSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * EspecieController implements the CRUD actions for Especie model.
 */
class EspecieController extends Controller
{
	/**
	 * Lists all Especie models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new EspecieSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Especie model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($idEspecie)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idEspecie),
		]);
	}

	/**
	 * Creates a new Especie model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Especie;

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
	 * Updates an existing Especie model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($idEspecie)
	{
		$model = $this->findModel($idEspecie);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Especie model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($idEspecie)
	{
		$this->findModel($idEspecie)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Especie model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Especie the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($idEspecie)
	{
		if (($model = Especie::findOne($idEspecie)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
        

        /**
         * Finds the Especie model based on its name.
         * @param String $nomeEspecie
         * @param int $id PK of Especie
         * @return Json the list of models
         */
        public function actionFindespecie($nomeEspecie = null, $id = null)
        {
            $out = [];

            if (!is_null( $nomeEspecie ))
            {
                $especies = Especie::find()->where(["like", "Nome", $nomeEspecie])->all();
                $json = [];
                foreach ($especies as $especie)
                {
                    $json[] = ["id" => $especie->primaryKey, "text" => $especie->getLabel()];
                }
                $out['results'] = $json;
            } elseif ($id > 0)
            {
                $out['results'] = ['id' => $id, 'text' => Especie::findOne($id)->getLabel()];
            } else
            {
                $especies = Especie::find()->all();
                $json = [];
                foreach ($especies as $especie)
                {
                    $json[] = ["id" => $especie->primaryKey, "text" => $especie->getLabel()];
                }
                $out['results'] = $json;
            }
            return \yii\helpers\Json::encode($out);
        }
}
