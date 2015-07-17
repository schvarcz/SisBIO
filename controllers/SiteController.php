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
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            return $this->goHome();
        }
        $model = Pesquisador::findOne(["authKey" => $authKey]);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect("login");
        }

        if ($model)
        {
            return $this->render('active', [
                        'model' => $model,
            ]);
        } else
        {
            throw new HttpException(404, "Chame de autenticação de conta não encontrada.");
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
