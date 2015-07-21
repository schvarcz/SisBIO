<?php

namespace app\controllers;

use app\models\Coleta;
use app\models\ColetaSearch;
use yii\web\Controller;
use yii\web\HttpException;
use app\models\Especie;
use app\models\TipoOrganismo;
use app\models\NaoIdentificado;
use app\models\Descritor;
use yii\helpers\Url;
use app\widgets\DescritoresEspecie\DescritoresEspecie;

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
     * Updates an existing Coleta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idColeta)
    {
        $model = $this->findModel($idColeta);

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
        if (($model = Coleta::findOne($idColeta)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Finds the Espécie model based on its name.
     * @param String $name
     * @return Json the list of models
     */
    public function actionFindesp($nomeEspecie = null)
    {
        if (!is_null($nomeEspecie))
        {
            $especies = Especie::find()->where(["like", "NomeComum", $nomeEspecie])->where(["like", "NomeCientifico", $nomeEspecie])->all();
        } else
        {
            $especies = Especie::find()->limit(10)->all();
        }
        $jsonEspecie = [];
        foreach ($especies as $especie)
        {
            $jsonEspecie[] = ["id" => "E" . $especie->primaryKey, "text" => $especie->getLabel()];
        }

        if (!is_null($nomeEspecie))
        {
            $tipoOrganismo = TipoOrganismo::find()->where(["like", "Nome", $nomeEspecie])->all();
        } else
        {
            $tipoOrganismo = TipoOrganismo::find()->limit(10)->all();
        }
        $jsonOrganismos = [];
        foreach ($tipoOrganismo as $organismo)
        {
            $jsonOrganismos[] = ["id" => "O" . $organismo->primaryKey, "text" => $organismo->getLabel()];
        }
        $out = [];

        if ($jsonEspecie != [])
            $out[] = ["text" => "Espécies", "children" => $jsonEspecie];

        if ($jsonOrganismos != [])
            $out[] = ["text" => "Grupo Biológico", "children" => $jsonOrganismos];

        return \yii\helpers\Json::encode(["results" => $out]);
    }

    /**
     * Finds the Descritor model based on its name.
     * @param String $name
     * @return Json the list of models
     */
    public function actionFindvariavelecossistemica($nomeDescritor = null)
    {

        if (!is_null($nomeDescritor))
        {
            $descritores = Descritor::find()->where(["like", "Nome", $nomeDescritor])->andWhere(["idTipoDescritor" => 3])->all();
        } else
        {
            $descritores = Descritor::find()->where(["idTipoDescritor" => 3])->limit(10)->all();
        }
        $json = [];
        foreach ($descritores as $descritor)
        {
            $json[] = ["id" => $descritor->primaryKey, "text" => $descritor->getLabel()];
        }
        return \yii\helpers\Json::encode(["results" => $json]);
    }

    /**
     * Finds the Especie model based on its name.
     * @param String $name
     * @return Json the list of models
     */
    public function actionAdddescritor($tipoDescritor, $primaryKey)
    {
        $entidade = $primaryKey[0];
        $primaryKey[0] = 0;
        $primaryKey = (int) $primaryKey;
        if ($entidade == "O")
            $model = TipoOrganismo::findOne($primaryKey);
        else
            $model = Especie::findOne($primaryKey);
        $out = [];
        if ($model !== null)
        {
            return DescritoresEspecie::widget(["name" => "especie", "model" => $model, "tipoDescritor" => $tipoDescritor]);
        }
    }

    /**
     * Localiza o model da Variável Ambiental com base no nome.
     * @param String $name
     * @return Json Lista de models
     */
    public function actionAdddescritoresambiental($tipoDescritor, $primaryKey)
    {
        $model = Descritor::findOne($primaryKey);

        if ($model !== null)
        {
            return DescritoresEspecie::widget(["name" => "variavel-ambiental", "model" => $model, "tipoDescritor" => $tipoDescritor]);
        }
    }

}
