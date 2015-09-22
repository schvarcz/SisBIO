<?php

namespace app\controllers;

use app\models\Metodo;
use app\models\MetodoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * MetodoController implements the CRUD actions for Metodo model.
 */
class MetodoController extends Controller
{

    /**
     * Lists all Metodo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetodoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Metodo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idMetodo)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idMetodo),
        ]);
    }

    /**
     * Creates a new Metodo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Metodo;

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
     * Updates an existing Metodo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idMetodo)
    {
        $model = $this->findModel($idMetodo);

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
     * Deletes an existing Metodo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idMetodo)
    {
        $this->findModel($idMetodo)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Metodo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Metodo the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idMetodo)
    {
        if (($model = Metodo::findOne($idMetodo)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Finds the Metodo model based on its name.
     * @param String $nomeMetodo
     * @param int $id PK of Metodo
     * @return Json the list of models
     */
    public function actionFindmetodo($nomeMetodo = null, $id = null)
    {
        $out = [];

        if (!is_null($nomeMetodo))
        {
            $metodos = Metodo::find()->where(["like", "Nome", $nomeMetodo])->all();
            $json = [];
            foreach ($metodos as $metodo)
            {
                $json[] = ["id" => $metodo->primaryKey, "text" => $metodo->getLabel()];
            }
            $out['results'] = $json;
        } elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => Metodo::findOne($id)->getLabel()];
        } else
        {
            $metodos = Metodo::find()->all();
            $json = [];
            foreach ($metodos as $metodo)
            {
                $json[] = ["id" => $metodo->primaryKey, "text" => $metodo->getLabel()];
            }
            $out['results'] = $json;
        }
        return \yii\helpers\Json::encode($out);
    }

}
