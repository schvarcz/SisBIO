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
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idProjeto' => $model->idProjeto], ['class' => 'btn btn-info'])
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Projeto', ['create'], ['class' => 'btn
        btn-success']) ?>
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
                "attribute" => "ativo",
                "value" => $model->ativo ? "Sim" : "Não"
            ],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idPesquisadorResponsavel',
                'value' => ($model->getIdPesquisadorResponsavel0()->one() ? Html::a($model->getIdPesquisadorResponsavel0()->one()->label, ['pesquisador/view', 'idPesquisador' => $model->getIdPesquisadorResponsavel0()->one()->idPesquisador,]) : '<span class="label label-warning">?</span>'),
            ],
            'Descricao:ntext',
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idProjeto' => $model->idProjeto], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
        'data-method' => 'post',
    ]);
    ?>

    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('IdPesquisadores'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todos os pesquisadores', ['pesquisador/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Novo Pesquisador', ['pesquisador/create', 'IdPesquisador' => ['idPesquisador' => $model->idProjeto]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-IdPesquisadores', 'linkSelector' => '#pjax-IdPesquisadores ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPesquisadorHasProjetos(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 
            'idPesquisador0.foto',
            'idPesquisador0.Nome',
            'idPesquisador0.email',
            'idPesquisador0.lattes',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function($action, $model, $key, $index)
        {
            // using the column name as key, not mapping to 'id' like the standard generator
            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
            $params[0] = 'pesquisador-has-projeto' . '/' . $action;
            return \yii\helpers\Url::toRoute($params);
        },
                'buttons' => [
                    'delete' => function ($url, $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'class' => 'text-danger',
                                    'title' => Yii::t('yii', 'Remove'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete the related item?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                        ]);
                    },
                            'view' => function ($url, $model)
                    {
                        return Html::a(
                                        '<span class="glyphicon glyphicon-cog"></span>', $url, [
                                    'data-title' => Yii::t('yii', 'View Pivot Record'),
                                    'data-toggle' => 'tooltip',
                                    'data-pjax' => '0',
                                    'class' => 'text-muted'
                                        ]
                        );
                    },
                        ],
                        'controller' => 'pesquisador-has-projeto'
                    ],]
            ]);
            ?>
            <?php Pjax::end() ?>
            <?php $this->endBlock() ?>


            <?php $this->beginBlock('UnidadeGeograficas'); ?>
            <p class='pull-right'>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-list"></span> Listar todas as unidades geográficas', ['unidade-geografica/index'], ['class' => 'btn text-muted btn-xs']
                )
                ?>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geográfica', ['unidade-geografica/create', 'UnidadeGeografica' => ['idProjeto' => $model->idProjeto]], ['class' => 'btn btn-success btn-xs']
                )
                ?>
            </p><div class='clearfix'></div>
            <?php Pjax::begin(['id' => 'pjax-UnidadeGeograficas', 'linkSelector' => '#pjax-UnidadeGeograficas ul.pagination a']) ?>
            <?=
            \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getUnidadeGeograficas(), 'pagination' => ['pageSize' => 10]]),
                'columns' => [ 'idUnidadeGeografica',
                    'Nome',
                    'Data_Criacao',
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
                                        'template' => '{view} {update}',
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
                                                'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Pesquisadores envolvidos</small>',
                                                'content' => $this->blocks['IdPesquisadores'],
                                                'active' => false,
                                            ], [
                                                'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Unidades geográficas associadas</small>',
                                                'content' => $this->blocks['UnidadeGeograficas'],
                                                'active' => false,
                                            ],]
                                    ]
                            );
                            ?></div>
