<?php

namespace app\controllers;

use app\models\Projeto;
use app\models\ProjetoSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\Pesquisador;
use app\widgets\PermissaoProjeto\PermissaoProjeto;

/**
 * ProjetoController implements the CRUD actions for Projeto model.
 */
class ProjetoController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['adminBase','adminProjeto', 'colaboradorProjeto'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'findprojeto'],
                        'roles' => ['adminBase','adminProjeto', 'colaboradorProjeto','verProjeto'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'addpermissao'],
                        'roles' => ['adminBase','adminProjeto', 'colaboradorProjeto'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['adminBase','adminProjeto'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Projeto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjetoSearch;
        $dataProvider = $searchModel->search($_GET);

        Url::remember();
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Projeto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idProjeto)
    {
        Url::remember();
        $model = $this->findModel($idProjeto);
        if(\Yii::$app->user->can("verProjeto",["projeto"=>$model]))
        {
            return $this->render('view', [
                        'model' => $model,
            ]);
        }
        throw new HttpException(403,"You are not allowed to perform this action.");
    }

    /**
     * Creates a new Projeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = \Yii::$app->user;
        if(!$user->can("adminBase"))
        {
            if (isset($_REQUEST["Projeto"]) && isset($_REQUEST["Projeto"]["idProjetoPai"]))
            {
                $model = $this->findModel($_REQUEST["Projeto"]["idProjetoPai"]);
                if (!$user->can("editarProjeto", ["projeto" => $model]))
                {
                    throw new HttpException(403, "You are not allowed to perform this action.");
                }
            } else
            {
                throw new HttpException(403, "You are not allowed to perform this action.");
            }
        }
        $model = new Projeto;

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
     * Updates an existing Projeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idProjeto)
    {
        $model = $this->findModel($idProjeto);
        
        if(\Yii::$app->user->can("editarProjeto",["projeto"=>$model]))
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
     * Deletes an existing Projeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idProjeto)
    {
        $model = $this->findModel($idProjeto);
        if(\Yii::$app->user->can("deletarProjetoProprio",["projeto"=>$model]))
        {
            $model->delete();
            return $this->redirect(Url::previous());
        }
        throw new HttpException(403,"You are not allowed to perform this action.");
    }

    /**
     * Finds the Projeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projeto the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($idProjeto)
    {
        if (($model = Projeto::findOne($idProjeto)) !== null)
        {
            return $model;
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionAddpermissao($idPesquisador)
    {
        if (($model = Pesquisador::findOne($idPesquisador)) !== null)
        {
            return PermissaoProjeto::widget(["name" => "projeto-permissao", "model" => $model]);
        } else
        {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }


    /**
     * Finds the Projeto model based on its name.
     * @param String $nomeProjeto
     * @param int $id PK of Projeto
     * @param int $action PK of Permissioes
     * @return Json the list of models
     */
    public function actionFindprojeto($nomeProjeto = null, $id = null, $action = null)
    {
        $out = [];

        if (!is_null($nomeProjeto))
        {
            $projetos = $this->onylAllowedProjetos(Projeto::find()->where(["like", "Projeto.Nome", $nomeProjeto]), $action)->all();
            $json = [];
            foreach ($projetos as $projeto)
            {
                $json[] = ["id" => $projeto->primaryKey, "text" => $projeto->getLabel()];
            }
            $out['results'] = $json;
        } elseif ($id > 0)
        {
            $out['results'] = ['id' => $id, 'text' => Projeto::findOne($id)->getLabel()];
        } else
        {
            $projetos = $this->onylAllowedProjetos(Projeto::find(), $action)->all();
            $json = [];
            foreach ($projetos as $projeto)
            {
                $json[] = ["id" => $projeto->primaryKey, "text" => $projeto->getLabel()];
            }
            $out['results'] = $json;
        }
        return \yii\helpers\Json::encode($out);
    }
    
    private function onylAllowedProjetos($projetoQuery, $operadorLevel = null)
    {
        if(!\Yii::$app->user->can("adminBase"))
        {
            $projetoQuery
                    ->orWhere(["idPesquisadorResponsavel" => \Yii::$app->user->id])
                    ->joinWith("idPesquisadores")
                    ->orWhere(["Pesquisador_has_Projeto.idPesquisador" => \Yii::$app->user->id])
                    ->joinWith("pesquisadorHasPermissoes");
            if ($operadorLevel)
            {
                $projetoQuery->orWhere(["Pesquisador_has_Permissoes.idPesquisador" => \Yii::$app->user->id, "Pesquisador_has_Permissoes.idPermissoes" => $operadorLevel]);
            }
        }
        return $projetoQuery;
    }
}
