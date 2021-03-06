<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Pesquisador;
use yii\web\HttpException;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'contato'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return Yii::$app->getResponse()->redirect(\yii\helpers\Url::toRoute("/coleta/index"));
        }
        $this->layout = "welcome";
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        } else
        {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionActive($authKey)
    {
        if (!\Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
        }
        $model = Pesquisador::findOne(["authKey" => $authKey]);

        if ($model)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect("login");
            }
            return $this->render('active', [
                        'model' => $model,
            ]);
        } else
        {
            throw new HttpException(404, "Chamada de autenticação de conta não encontrada.");
        }
    }

    public function actionReset($authKey)
    {
        if (!\Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
        }
        $model = Pesquisador::findOne(["authKey" => $authKey]);

        if ($model)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect("login");
            }
            return $this->render('reset', [
                        'model' => $model,
            ]);
        } else
        {
            throw new HttpException(404, "Chamada de autenticação de conta não encontrada.");
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContato()
    {
        return $this->render('contact');
    }

}
