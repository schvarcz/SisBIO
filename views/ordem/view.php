<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Ordem $model
 */
$this->title = 'Ordem ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Ordems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idOrdem' => $model->idOrdem]];
$this->params['breadcrumbs'][] = 'Detalhes';
?>
<div class="ordem-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idOrdem' => $model->idOrdem], ['class' => 'btn btn-info'])
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Ordem', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Ordem'); ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idOrdem',
            'NomeComum',
            'NomeCientifico',
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
            [
                'format' => 'html',
                'attribute' => 'idFilo',
                'value' => ($model->getIdFilo0()->one() ? Html::a($model->getIdFilo0()->one()->label, ['filo/view', 'idFilo' => $model->getIdFilo0()->one()->idFilo,]) : '<span class="label label-warning">?</span>'),
            ],
            'Descricao:ntext',
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idOrdem' => $model->idOrdem], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
        'data-method' => 'post',
    ]);
    ?>

    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('Familias'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todas as famílias', ['familia/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Nova Família', ['familia/create', 'Familia' => ['idOrdem' => $model->idOrdem]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-Familias', 'linkSelector' => '#pjax-Familias ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getFamilias(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idFamilia',
            'NomeComum',
            'NomeCientifico',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function($action, $model, $key, $index)
        {
            // using the column name as key, not mapping to 'id' like the standard generator
            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
            $params[0] = 'familia' . '/' . $action;
            return \yii\helpers\Url::toRoute($params);
        },
                'buttons' => [
                ],
                'controller' => 'familia'
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
                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Ordem',
                        'content' => $this->blocks['app\models\Ordem'],
                        'active' => true,
                    ], [
                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Famílias</small>',
                        'content' => $this->blocks['Familias'],
                        'active' => false,
                    ],]
            ]
    );
    ?></div>
