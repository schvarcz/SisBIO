<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var app\models\Metodo $model
 */
$this->title = 'Método: ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Métodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idMetodo' => $model->idMetodo]];
$this->params['breadcrumbs'][] = 'Detalhes';
?>
<div class="metodo-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idMetodo' => $model->idMetodo], ['class' => 'btn btn-info'])
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Método', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Metodo'); ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMetodo',
            'Nome',
            'Descricao:ntext',
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idMetodo' => $model->idMetodo], [
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
                '<span class="glyphicon glyphicon-plus"></span> Nova Coleta', ['coleta/create', 'Coleta' => ['idMetodo' => $model->idMetodo]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-Coletas', 'linkSelector' => '#pjax-Coletas ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetas(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idColeta',
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


                    <?=
                    \yii\bootstrap\Tabs::widget(
                            [
                                'id' => 'relation-tabs',
                                'encodeLabels' => false,
                                'items' => [ [
                                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Método',
                                        'content' => $this->blocks['app\models\Metodo'],
                                        'active' => true,
                                    ], [
                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Coletas</small>',
                                        'content' => $this->blocks['Coletas'],
                                        'active' => false,
                                    ],]
                            ]
                    );
                    ?></div>