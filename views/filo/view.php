<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Filo $model
 */
$this->title = 'Filo ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Filos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idFilo' => $model->idFilo]];
$this->params['breadcrumbs'][] = 'Detalhes';
?>
<div class="filo-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idFilo' => $model->idFilo], ['class' => 'btn btn-info'])
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Filo', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Filo'); ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idFilo',
            'NomeComum',
            'NomeCientifico',
            'Descricao:ntext',
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idFilo' => $model->idFilo], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
        'data-method' => 'post',
    ]);
    ?>

<?php $this->endBlock(); ?>



        <?php $this->beginBlock('Ordems'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todas as ordems', ['ordem/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Nova Ordem', ['ordem/create', 'Ordem' => ['idFilo' => $model->idFilo]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-Ordems', 'linkSelector' => '#pjax-Ordems ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getOrdems(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idOrdem',
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
            $params[0] = 'ordem' . '/' . $action;
            return \yii\helpers\Url::toRoute($params);
        },
                'buttons' => [
                ],
                'controller' => 'ordem'
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
                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Filo',
                        'content' => $this->blocks['app\models\Filo'],
                        'active' => true,
                    ], [
                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Ordems</small>',
                        'content' => $this->blocks['Ordems'],
                        'active' => false,
                    ],]
            ]
    );
    ?></div>
