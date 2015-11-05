<?php

namespace app\controllers;

use app\models\TipoOrganismo;
use app\models\TipoOrganismoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\Metodo;

/**
 * TipoOrganismoController implements the CRUD actions for TipoOrganismo model.
 */
class TipoOrganismoController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create','delete', 'update', 'view'],
                        'roles' => ['adminOrganismo'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['findtipoorganismo', 'findmetodos'],
                        'roles' => ['admColetas'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all TipoOrganismo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoOrganismoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TipoOrganismo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idTipoOrganismo)
    {
        Url::remember();
        $model = $this->findModel($idTipoOrganismo);
        if(\Yii::$app->user->can("adminOrganismo",["tipoOrganismo"=>$model]))
        {
            return $this->render('view', [
                        'model' => $model,
            ]);
        }
        throw new HttpException(403,"You are not allowed to perform this action.");
    }

    /**
     * Creates a new TipoOrganismo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoOrganismo;
        try
        {
            if ($model->saveWithRelated($_POST))
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
     * Updates an existing TipoOrganismo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idTipoOrganismo)
    {
        $model = $this->findModel($idTipoOrganismo);

        if(\Yii::$app->user->can("adminOrganismo",["tipoOrganismo"=>$model]))
        {
            if ($model->saveWithRelated($_POST))
            {
                return $this->redirect(Url::previous());
            } else
            {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
        throw new HttpException(403,"You are not allowed to perform this action.");
    }

    /**
     * Deletes an existing TipoOrganismo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idTipoOrganismo)
    {
        $model = $this->findModel($idTipoOrganismo);
        if(\Yii::$app->user->can("adminOrganismo",["tipoOrganismo"=>$model]))
        {
            $model->delete();
            return $this->redirect(Url::previous());
        }
        throw new HttpException(403,"You are not allowed to perform this action.");
    }

    /**
     * Finds the TipoOrganismo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoOrganismo the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idTipoOrganismo)
    {
        if (($model = TipoOrganismo::findOne($idTipoOrganismo)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }


    /**
     * Finds the TipoOrganismo model based on its name.
     * @param String $nomeOrganismo
     * @param int $id PK of TipoOrganismo
     * @return Json the list of models
     */
    public function actionFindtipoorganismo($nomeOrganismo = null, $id = null)
    {
        $out = [];

        if (!is_null($nomeOrganismo))
        {
            $organismos = TipoOrganismo::find()->where(["like", "Nome", $nomeOrganismo])->all();
            $json = [];
            foreach ($organismos as $organismo)
            {
                $json[] = ["id" => $organismo->primaryKey, "text" => $organismo->getLabel()];
            }
            $out['results'] = $json;
        } elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => TipoOrganismo::findOne($id)->getLabel()];
        } else
        {
            $organismos = TipoOrganismo::find()->all();
            $json = [];
            foreach ($organismos as $organismo)
            {
                $json[] = ["id" => $organismo->primaryKey, "text" => $organismo->getLabel()];
            }
            $out['results'] = $json;
        }
        return \yii\helpers\Json::encode($out);
    }

    /**
     * Finds the Metodos with his TipoOrganismo model based on its name.
     * @param String $name
     * @return Json the list of models
     */
    public function actionFindmetodos($nomeMetodo = null, $id = null)
    {
        $out = [];
        if(!is_null($id))
        {
            $out['results'] = ['id' => $id, 'text' => Metodo::findOne($id)->getLabel()];
            return \yii\helpers\Json::encode($out);
        }
        
        $tipoOrganismos = TipoOrganismo::find()->all();
        foreach ($tipoOrganismos as $organismo)
        {
            if (!is_null($nomeMetodo))
            {
                $metodos = $organismo->getIdMetodos()->where(["like", "Nome", $nomeMetodo])->all();
            } else
            {
                $metodos = $organismo->getIdMetodos()->limit(10)->all();
            }
            
            $jsonMetodos = [];
            
            foreach($metodos as $metodo)
                $jsonMetodos[] = ["id" => $metodo->primaryKey, "text" => $metodo->getLabel(), "idTipoOrganismo" => $organismo->primaryKey];
            
            if ($jsonMetodos != [])
                $out[] = ["text" => $organismo->label, "children" => $jsonMetodos];
        }
       
        return \yii\helpers\Json::encode(["results" => $out]);
    }
}
