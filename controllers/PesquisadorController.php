<?php

namespace app\controllers;

use app\models\Pesquisador;
use app\models\PesquisadorSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use Yii;
use yii\web\UploadedFile;

/**
 * PesquisadorController implements the CRUD actions for Pesquisador model.
 */
class PesquisadorController extends Controller {

    /**
     * Lists all Pesquisador models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PesquisadorSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}


    /**
     * Displays a single Pesquisador model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idPesquisador) {
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($idPesquisador),
		]);
	}


    /**
     * Creates a new Pesquisador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Pesquisador;
        if (Yii::$app->request->isPost) {
            $model->load($_POST);
//                if($model->photo)
            $model->photo = UploadedFile::getInstance($model, 'photo');
            $hash = md5(time());
            $photoPath = 'photos/' . $hash . '.' . $model->photo->extension;
            $model->photo->saveAs('photos/' . $hash . '.' . $model->photo->extension);

            try {
                if ($model->load($_POST)) {
                    $model->foto = $photoPath;
                    if ($model->save()) {
                        return $this->redirect(Url::previous());
                    }
                } elseif (!\Yii::$app->request->isPost) {
                    $model->load($_GET);
                }
            } catch (\Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                $model->addError('_exception', $msg);
            }
        }
        
        return $this->render('create', ['model' => $model,]);
	}

    /**
     * Updates an existing Pesquisador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idPesquisador) {
        $model = $this->findModel($idPesquisador);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pesquisador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idPesquisador) {
        $this->findModel($idPesquisador)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Pesquisador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pesquisador the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idPesquisador) {
        if (($model = Pesquisador::findOne($idPesquisador)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Finds the Pesquisador model based on its name.
     * @param String $pesquisador
     * @param int $id PK of Pesquisador
     * @return Json the list of models
     */
    public function actionFindpesquisador($pesquisador = null, $id = null) {
        $out = [];

        if (!is_null($pesquisador)) {
            $pesquisadores = Pesquisador::find()->where(["like", "Nome", $pesquisador])->all();
            $json = [];
            foreach ($pesquisadores as $pesq) {
                $json[] = ["id" => $pesq->primaryKey, "text" => $pesq->getLabel()];
            }
            $out['results'] = $json;
        } elseif (is_string($id)) { //If its initial value is a multiple selection
            $out['results'] = [];
            $ids = explode(",", $id);
            foreach ($ids as $id)
                $out['results'][] = ['id' => $id, 'text' => Pesquisador::findOne($id)->getLabel()];
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Pesquisador::findOne($id)->getLabel()];
        } elseif ($id != "null") {
            $pesquisadores = Pesquisador::find()->all();
            $json = [];
            foreach ($pesquisadores as $pesq) {
                $json[] = ["id" => $pesq->primaryKey, "text" => $pesq->getLabel()];
            }
            $out['results'] = $json;
        }
        return \yii\helpers\Json::encode($out);
    }
}
