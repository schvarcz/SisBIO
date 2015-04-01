<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UnidadeGeograficaSearch $searchModel
 */
$this->title = 'Unidades Geográficas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="unidade-geografica-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geográfica', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">



            <?php
            echo \yii\bootstrap\ButtonDropdown::widget(
                    [
                        'id' => 'giiant-relations',
                        'encodeLabel' => false,
                        'label' => '<span class="glyphicon glyphicon-paperclip"></span> Relacionados',
                        'dropdown' => [
                            'options' => [
                                'class' => 'dropdown-menu-right'
                            ],
                            'encodeLabels' => false,
                            'items' => [
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-right"> Coleta</i>',
                                    'url' => [
                                        'coleta/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Projeto</i>',
                                    'url' => [
                                        'projeto/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Pesquisador</i>',
                                    'url' => [
                                        'pesquisador/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Unidade Geografica</i>',
                                    'url' => [
                                        'unidade-geografica/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-right"> Unidade Geografica</i>',
                                    'url' => [
                                        'unidade-geografica/index',
                                    ],
                                ],
                            ]],
                    ]
            );
            ?>        </div>
    </div>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'idUnidadeGeografica',
            'Nome',
            'Data_Criacao',
            // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
            [
                "class" => yii\grid\DataColumn::className(),
                "attribute" => "idProjeto",
                "value" => function($model)
                {
                    if ($rel = $model->getIdProjeto0()->one())
                    {
                        return yii\helpers\Html::a($rel->label, ["projeto/view", 'idProjeto' => $rel->idProjeto,], ["data-pjax" => 0]);
                    } else
                    {
                        return '';
                    }
                },
                        "format" => "raw",
                    ],
                    // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                    [
                        "class" => yii\grid\DataColumn::className(),
                        "attribute" => "idPesquisador",
                        "value" => function($model)
                        {
                            if ($rel = $model->getIdPesquisador0()->one())
                            {
                                return yii\helpers\Html::a($rel->label, ["pesquisador/view", 'idPesquisador' => $rel->idPesquisador,], ["data-pjax" => 0]);
                            } else
                            {
                                return '';
                            }
                        },
                                "format" => "raw",
                            ],
                            // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                            [
                                "class" => yii\grid\DataColumn::className(),
                                "attribute" => "idUnidadeGeograficaPai",
                                "value" => function($model)
                                {
                                    if ($rel = $model->getIdUnidadeGeograficaPai0()->one())
                                    {
                                        return yii\helpers\Html::a($rel->label, ["unidade-geografica/view", 'idUnidadeGeografica' => $rel->idUnidadeGeografica,], ["data-pjax" => 0]);
                                    } else
                                    {
                                        return '';
                                    }
                                },
                                        "format" => "raw",
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'urlCreator' => function($action, $model, $key, $index)
                                        {
                                            // using the column name as key, not mapping to 'id' like the standard generator
                                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                            $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                                            return \yii\helpers\Url::toRoute($params);
                                        },
                                                'contentOptions' => ['nowrap' => 'nowrap']
                                            ],
                                        ],
                                    ]);
                                    ?>

</div>
