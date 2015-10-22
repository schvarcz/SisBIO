<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 */
$this->title = 'Projeto ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idProjeto' => $model->idProjeto]];
$this->params['breadcrumbs'][] = 'Detalhes';
?>
<div class="projeto-view">

    <p class='pull-left'>
        <?php
            if (\Yii::$app->user->can("editarProjeto", ["projeto" => $model]))
            {
                echo Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idProjeto' => $model->idProjeto], ['class' => 'btn btn-info']);
            }
        ?>
        <?php
            if (\Yii::$app->user->can("adminBase"))
            {
                echo Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Projeto', ['create'], ['class' => 'btn
            btn-success']);
            }
        ?>

        </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Projeto'); ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProjeto',
            'Nome',
            'Data_Inicio',
            'Data_Fim',
            [
                'attribute' => 'ativo',
                'value' => $model->ativo ? "Sim" : "Não"
            ],
            // generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idPesquisadorResponsavel',
                'value' => ($model->getIdPesquisadorResponsavel0()->one() ? Html::a($model->getIdPesquisadorResponsavel0()->one()->label, ['pesquisador/view', 'idPesquisador' => $model->getIdPesquisadorResponsavel0()->one()->idPesquisador,]) : '<span class="label label-warning">?</span>'),
            ],
            'Descricao:ntext',
            // generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idProjetoPai',
                'value' => ($model->getIdProjetoPai0()->one() ? Html::a($model->getIdProjetoPai0()->one()->label, ['projeto/view', 'idProjeto' => $model->getIdProjetoPai0()->one()->idProjeto,]) : '<span class="label label-warning">?</span>'),
            ],
        ],
    ]);
    ?>

    <hr/>

    <?php
        if(\Yii::$app->user->can("deletarProjeto",["projeto"=>$model]))
        {
            echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idProjeto' => $model->idProjeto], [
                'class' => 'btn btn-danger',
                'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
                'data-method' => 'post',
            ]);
        }
    ?>

    <?php $this->endBlock(); ?>


    <?php $this->beginBlock('PesquisadorHasPermissoes'); ?>
    <p class='pull-right'>&nbsp;
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-PesquisadorHasPermissoes', 'linkSelector' => '#pjax-PesquisadorHasPermissoes ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getViewPesquisadorPermissoes(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idPesquisador0.Nome',
            'Administrar Coletas',
            'Administrar Unidades Geográficas',
            'Visualizar dados',
            'Exportar dados',
        ]
    ]);
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>

    <?php $this->beginBlock('IdPesquisadores'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todos Pesquisadores', ['pesquisador/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-IdPesquisadores', 'linkSelector' => '#pjax-IdPesquisadores ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPesquisadorHasProjetos(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [
            'idPesquisador0.Nome',
            'idPesquisador0.email:email',
            'idPesquisador0.lattes:url',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function($action, $model, $key, $index)
                {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = 'pesquisador' . '/' . $action;
                    return \yii\helpers\Url::toRoute($params);
                },
                'buttons' => [
                    'view' => function ($url, $model)
                    {
                        return Html::a(
                                        '<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'data-title' => Yii::t('yii', 'View Pivot Record'),
                                    'data-toggle' => 'tooltip',
                                    'data-pjax' => '0',
                                    'class' => 'text-muted'
                                        ]
                        );
                    },
                        ],
                        'controller' => 'pesquisador-has-projeto'
                    ],
                ]
            ]);
            ?>
            <?php Pjax::end() ?>
            <?php $this->endBlock() ?>


            <?php $this->beginBlock('Projetos'); ?>
            <p class='pull-right'>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-list"></span> Listar todos Projetos', ['projeto/index'], ['class' => 'btn text-muted btn-xs']
                )
                ?>
                <?php
                if (\Yii::$app->user->can("criarSubprojeto", ["projeto" => $model]))
                {
                    echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Projeto Filho', ['projeto/create', 'Projeto' => ['idProjetoPai' => $model->idProjeto]], ['class' => 'btn btn-success btn-xs']);
                }
                ?>
            </p><div class='clearfix'></div>
            <?php Pjax::begin(['id' => 'pjax-Projetos', 'linkSelector' => '#pjax-Projetos ul.pagination a']) ?>
            <?=
            \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getProjetos(), 'pagination' => ['pageSize' => 10]]),
                'columns' => [ 'idProjeto',
                    'Nome',
                    'Data_Inicio',
                    'Data_Fim',
                    [
                        "attribute" => "ativo",
                        "value" => function ($model, $key, $index, $column)
                        {
                            return $key ? "Sim" : "Não";
                        }
                    ],
                    // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                    [
                        "class" => yii\grid\DataColumn::className(),
                        "attribute" => "idPesquisadorResponsavel",
                        "value" => function($model)
                        {
                            if ($rel = $model->getIdPesquisadorResponsavel0()->one())
                            {
                                return yii\helpers\Html::a($rel->label, ["pesquisador/view", 'idPesquisador' => $rel->idPesquisador,], ["data-pjax" => 0]);
                            } else
                            {
                                return '';
                            }
                        },
                                "format" => "raw",
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}'.((\Yii::$app->user->can("editarProjeto", ["projeto" => $model]))?' {update}':''),
                        'contentOptions' => ['nowrap' => 'nowrap'],
                        'urlCreator' => function($action, $model, $key, $index)
                        {
                            // using the column name as key, not mapping to 'id' like the standard generator
                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                            $params[0] = 'projeto' . '/' . $action;
                            return \yii\helpers\Url::toRoute($params);
                        },
                                'buttons' => [
                                ],
                                'controller' => 'projeto'
                            ],
                        ]
                    ]);
                    ?>
                    <?php Pjax::end() ?>
                    <?php $this->endBlock() ?>


            <?php $this->beginBlock('UnidadeGeograficas'); ?>
            <p class='pull-right'>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-list"></span> Listar todas Unidade Geograficas', ['unidade-geografica/index'], ['class' => 'btn text-muted btn-xs']
                )
                ?>
                <?php
                if (\Yii::$app->user->can("adminUnidadeGeografica", ["projeto" => $model]))
                {
                    echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geografica', ['unidade-geografica/create', 'UnidadeGeografica' => ['idProjeto' => $model->idProjeto]], ['class' => 'btn btn-success btn-xs']);
                }
                ?>
            </p><div class='clearfix'></div>
            <?php Pjax::begin(['id' => 'pjax-UnidadeGeograficas', 'linkSelector' => '#pjax-UnidadeGeograficas ul.pagination a']) ?>
            <?=
            \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getUnidadeGeograficas(), 'pagination' => ['pageSize' => 10]]),
                'columns' => [ 'idUnidadeGeografica',
                    'Nome',
                    'Data_Coordenadas',
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
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{view}'.(\Yii::$app->user->can("adminUnidadeGeografica", ["projeto" => $model])?'{update} {delete}':''),
                                        'contentOptions' => ['nowrap' => 'nowrap'],
                                        'urlCreator' => function($action, $model, $key, $index)
                                {
                                    // using the column name as key, not mapping to 'id' like the standard generator
                                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                    $params[0] = 'unidade-geografica' . '/' . $action;
                                    return \yii\helpers\Url::toRoute($params);
                                },
                                        'buttons' => [
                                        ],
                                        'controller' => 'unidade-geografica'
                                    ],]
                            ]);
                            ?>
                            <?php Pjax::end() ?>
                            <?php $this->endBlock() ?>


                                    <?php $this->beginBlock('Coletas'); ?>
                                    <p class='pull-right'>
                                        <?=
                                        \yii\helpers\Html::a(
                                                '<span class="glyphicon glyphicon-list"></span> Listar todas Coletas', ['coleta/index'], ['class' => 'btn text-muted btn-xs']
                                        )
                                        ?>
                                        <?php
                                            if (\Yii::$app->user->can("adminColeta", ["projeto" => $model]))
                                            {
                                                echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Coleta', ['coleta/create', 'Coleta' => ['idProjeto' => $model->idProjeto]], ['class' => 'btn btn-success btn-xs']);
                                            }
                                        ?>
                                    </p><div class='clearfix'></div>
                                    <?php Pjax::begin(['id' => 'pjax-Coletas', 'linkSelector' => '#pjax-Coletas ul.pagination a']) ?>
                                    <?=
                                    \yii\grid\GridView::widget([
                                        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetas(), 'pagination' => ['pageSize' => 10]]),
                                        'columns' => [ 
                                                'idColeta',
                                                'Data_Coleta',
                                                // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                                                [
                                                    "class" => yii\grid\DataColumn::className(),
                                                    "attribute" => "idMetodo",
                                                    "value" => function($model)
                                                    {
                                                        if ($rel = $model->getIdMetodo0()->one())
                                                        {
                                                            return yii\helpers\Html::a($rel->label, ["metodo/view", 'idMetodo' => $rel->idMetodo,], ["data-pjax" => 0]);
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
                                                    "attribute" => "idUnidadeGeografica",
                                                    "value" => function($model)
                                                    {
                                                        if ($rel = $model->getIdUnidadeGeografica0()->one())
                                                        {
                                                            return yii\helpers\Html::a($rel->label, ["unidade-geografica/view", 'idUnidadeGeografica' => $rel->idUnidadeGeografica,], ["data-pjax" => 0]);
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
                                                    "attribute" => "idPesquisadorRegistro",
                                                    "value" => function($model)
                                                    {
                                                        if ($rel = $model->getIdPesquisadorRegistro0()->one())
                                                        {
                                                            return yii\helpers\Html::a($rel->label, ["pesquisador/view", 'idPesquisador' => $rel->idPesquisador,], ["data-pjax" => 0]);
                                                        } else
                                                        {
                                                            return '';
                                                        }
                                                    },
                                                            "format" => "raw",
                                                ],
                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'template' => '{view}'.(\Yii::$app->user->can("adminColeta", ["projeto" => $model])?' {update} {delete}':''),
                                                    'contentOptions' => ['nowrap' => 'nowrap'],
                                                    'urlCreator' => function($action, $model, $key, $index)
                                                    {
                                                        // using the column name as key, not mapping to 'id' like the standard generator
                                                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                                        $params[0] = 'coleta' . '/' . $action;
                                                        return \yii\helpers\Url::toRoute($params);
                                                    },
                                                    'buttons' => [
                                                    ],
                                                    'controller' => 'coleta'
                                                ],
                                        ]
                                    ]);
                                    ?>
                                    <?php Pjax::end() ?>
                                    <?php $this->endBlock() ?>


                                    <?=
                                    \yii\bootstrap\Tabs::widget(
                                            [
                                                'id' => 'relation-tabs',
                                                'encodeLabels' => false,
                                                'items' => [ [
                                                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Projeto',
                                                        'content' => $this->blocks['app\models\Projeto'],
                                                        'active' => true,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Projetos Filhos</small>',
                                                        'content' => $this->blocks['Projetos'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Unidade Geograficas</small>',
                                                        'content' => $this->blocks['UnidadeGeograficas'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Coletas</small>',
                                                        'content' => $this->blocks['Coletas'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span>Pesquisadores Colaboradores</small>',
                                                        'content' => $this->blocks['IdPesquisadores'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Permissões por Perquisador</small>',
                                                        'content' => $this->blocks['PesquisadorHasPermissoes'],
                                                        'active' => false,
                                                    ],]
                                            ]
                                    );
                                    ?></div>
