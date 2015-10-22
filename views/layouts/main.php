<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'SisBIO',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '+ Coleta', 'url' => ['/coleta'], 'visible' => Yii::$app->user->can("adminColeta")],
                    ['label' => 'Não Identificados', 'url' => ['/nao-identificado'], 'visible' => Yii::$app->user->can("adminColeta")],
                    ['label' => 'Unidade Geográfica', 'url' => ['/unidade-geografica'], 'visible' => Yii::$app->user->can("adminUnidadeGeografica")],
                    ['label' => 'Tipos de Organismo', 'url' => ['/tipo-organismo'], 'visible' => Yii::$app->user->can("adminOrganismo")],//Na verdade ainda nem existe!
                    ['label' => 'Taxonomia', 'items' => [
                            ['label' => 'Filo/Divisão', 'url' => ['/filo']],
                            ['label' => 'Ordem', 'url' => ['/ordem']],
                            ['label' => 'Família', 'url' => ['/familia']],
                            ['label' => 'Gênero', 'url' => ['/genero']],
                            ['label' => 'Espécie', 'url' => ['/especie']],
                        ], 'visible' => Yii::$app->user->can("adminTaxonomia")],
                    ['label' => 'Base', 'items' => [
                            ['label' => 'Pesquisadores', 'url' => ['/pesquisador'], 'visible' => Yii::$app->user->can("adminPesquisadores")],
                            ['label' => 'Projetos', 'url' => ['/projeto'], 'visible' => Yii::$app->user->can("verProjeto")],
                            ['label' => 'Descritores', 'url' => ['/descritor'], 'visible' => Yii::$app->user->can("adminDescritores")],
                            ['label' => 'Métodos de Coleta', 'url' => ['/metodo'], 'visible' => Yii::$app->user->can("adminMetodos")],
                            ['label' => 'Tipos de Descritor', 'url' => ['/tipo-descritor'], 'visible' => Yii::$app->user->can("adminDescritores")],
                            ['label' => 'Tipos de Dado', 'url' => ['/tipo-dado'], 'visible' => Yii::$app->user->can("adminTipoDados")],
                        ], 'visible' => 
                                    Yii::$app->user->can("adminPesquisadores") 
                                    || Yii::$app->user->can("verProjeto")
                                    || Yii::$app->user->can("adminDescritores")
                                    || Yii::$app->user->can("adminMetodos")
                                    || Yii::$app->user->can("adminTipoDados")],
                    ['label' => 'Contato', 'url' => ['/site/contato'], 'visible' => Yii::$app->user->isGuest],
                    Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/site/login']] :
                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Ecoqua <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
