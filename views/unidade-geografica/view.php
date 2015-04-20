<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use app\widgets\GMaps\GMaps;

/**
 * @var yii\web\View $this
 * @var app\models\UnidadeGeografica $model
 */
$this->title = 'Unidade Geografica ' . $model->getLabel() . '';
$this->params['breadcrumbs'][] = ['label' => 'Unidades Geográficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idUnidadeGeografica' => $model->idUnidadeGeografica]];
$this->params['breadcrumbs'][] = 'Detalhes';
?>
<div class="unidade-geografica-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idUnidadeGeografica' => $model->idUnidadeGeografica], ['class' => 'btn btn-info'])
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geográfica', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\UnidadeGeografica'); ?>

    <?php
    echo GMaps::widget([ "model" => $model, "attribute" => "shape"]);
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idUnidadeGeografica',
            'Nome',
            'Data_Criacao',
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idProjeto',
                'value' => ($model->getIdProjeto0()->one() ? Html::a($model->getIdProjeto0()->one()->label, ['projeto/view', 'idProjeto' => $model->getIdProjeto0()->one()->idProjeto,]) : '<span class="label label-warning">?</span>'),
            ],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idPesquisador',
                'value' => ($model->getIdPesquisador0()->one() ? Html::a($model->getIdPesquisador0()->one()->label, ['pesquisador/view', 'idPesquisador' => $model->getIdPesquisador0()->one()->idPesquisador,]) : '<span class="label label-warning">?</span>'),
            ],
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idUnidadeGeograficaPai',
                'value' => ($model->getIdUnidadeGeograficaPai0()->one() ? Html::a($model->getIdUnidadeGeograficaPai0()->one()->label, ['unidade-geografica/view', 'idUnidadeGeografica' => $model->getIdUnidadeGeograficaPai0()->one()->idUnidadeGeografica,]) : '<span class="label label-warning">?</span>'),
            ],
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idUnidadeGeografica' => $model->idUnidadeGeografica], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
        'data-method' => 'post',
    ]);
    ?>

    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('Coletas'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todas Coletas', ['coleta/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Nova Coleta', ['coleta/create', 'Coleta' => ['idUnidadeGeografica' => $model->idUnidadeGeografica]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-Coletas', 'linkSelector' => '#pjax-Coletas ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetas(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idColeta',
            'Data_Coleta',
            'Observacao:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
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
            ],]
    ]);
    ?>
    <?php Pjax::end() ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('UnidadeGeograficas'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todas Unidades Geográficas', ['unidade-geografica/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geográfica', ['unidade-geografica/create', 'UnidadeGeografica' => ['idUnidadeGeograficaPai' => $model->idUnidadeGeografica]], ['class' => 'btn btn-success btn-xs']
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
                                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Unidade Geográfica',
                                        'content' => $this->blocks['app\models\UnidadeGeografica'],
                                        'active' => true,
                                    ], [
                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Coletas</small>',
                                        'content' => $this->blocks['Coletas'],
                                        'active' => false,
                                    ], [
                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Unidades Geográficas</small>',
                                        'content' => $this->blocks['UnidadeGeograficas'],
                                        'active' => false,
                                    ],]
                            ]
                    );
                    ?></div>
