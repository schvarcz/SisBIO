<?php

namespace app\controllers;

use app\models\NaoIdentificado;
use app\models\NaoIdentificadoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * NaoIdentificadoController implements the CRUD actions for NaoIdentificado model.
 */
class NaoIdentificadoController extends Controller
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
                        'roles' => ['adminColeta'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all NaoIdentificado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NaoIdentificadoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single NaoIdentificado model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idNaoIdentificado)
    {
        Url::remember();
        return $this->render('view', [
                    'model' => $this->findModel($idNaoIdentificado),
        ]);
    }

    /**
     * Updates an existing NaoIdentificado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idNaoIdentificado)
    {
        $model = $this->findModel($idNaoIdentificado);

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
     * Deletes an existing NaoIdentificado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idNaoIdentificado)
    {
        $this->findModel($idNaoIdentificado)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the NaoIdentificado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NaoIdentificado the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idNaoIdentificado)
    {
        if (($model = NaoIdentificado::findOne($idNaoIdentificado)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

}
