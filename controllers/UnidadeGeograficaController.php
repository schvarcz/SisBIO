<?php

namespace app\controllers;

use app\models\UnidadeGeografica;
use app\models\UnidadeGeograficaSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * UnidadeGeograficaController implements the CRUD actions for UnidadeGeografica model.
 */
class UnidadeGeograficaController extends Controller
{

    /**
     * Lists all UnidadeGeografica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UnidadeGeograficaSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single UnidadeGeografica model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idUnidadeGeografica)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idUnidadeGeografica),
        ]);
    }

    /**
     * Creates a new UnidadeGeografica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UnidadeGeografica;

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
     * Updates an existing UnidadeGeografica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idUnidadeGeografica)
    {
        $model = $this->findModel($idUnidadeGeografica);

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
     * Deletes an existing UnidadeGeografica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idUnidadeGeografica)
    {
        $this->findModel($idUnidadeGeografica)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the UnidadeGeografica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UnidadeGeografica the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idUnidadeGeografica)
    {
        if (($model = UnidadeGeografica::findOne($idUnidadeGeografica)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Finds the UnidadeGeografica model based on its name.
     * @param String $nomeUnidadeGeografica
     * @param int $id PK of UnidadeGeografica
     * @return Json the list of models
     */
    public function actionFindug($nomeUnidadeGeografica = null, $id = null)
    {
        $out = [];

        if (!is_null( $nomeUnidadeGeografica ))
        {
            $unidades = UnidadeGeografica::find()->where(["like", "Nome", $nomeUnidadeGeografica])->all();
            $json = [];
            foreach ($unidades as $unidade)
            {
                $json[] = ["id" => $unidade->primaryKey, "text" => $unidade->getLabel()];
            }
            $out['results'] = $json;
        } elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => UnidadeGeografica::findOne($id)->getLabel()];
        } else
        {
            $unidades = UnidadeGeografica::find()->all();
            $json = [];
            foreach ($unidades as $unidade)
            {
                $json[] = ["id" => $unidade->primaryKey, "text" => $unidade->getLabel()];
            }
            $out['results'] = $json;
        }
        return \yii\helpers\Json::encode($out);
    }

    /**
     * Retrieve polygon information about the UnidadeGeografica model based on its name.
     * @param int $id PK of UnidadeGeografica
     * @return Json the list of models
     */
    public function actionUgpolygon($idUnidadeGeografica)
    {
        $out = [];

        if ($idUnidadeGeografica > 0)
        {
            $ug = UnidadeGeografica::findOne($idUnidadeGeografica);
            $out['results'] = ["type" => $ug->getShapeGeometry(), "coords" => $ug->getShapeAsArray()];
        } else
        {
            $out['results'] = [];
        }
        return \yii\helpers\Json::encode($out);
    }
}