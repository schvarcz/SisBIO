<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\Coleta $model
*/

$this->title = 'Coleta View ' . $model->idColeta . '';
$this->params['breadcrumbs'][] = ['label' => 'Coletas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idColeta' => $model->idColeta]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="coleta-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'idColeta' => $model->idColeta],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Coleta', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Coleta'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'idColeta',
			'Data_Coleta',
			'Observacao:ntext',
// generated by schmunk42\giiant\crud\providers\RelationProvider::attributeFormat
[
    'format'=>'html',
    'attribute'=>'idUnidadeGeografica',
    'value' => ($model->getIdUnidadeGeografica0()->one() ? Html::a($model->getIdUnidadeGeografica0()->one()->label, ['unidade-geografica/view', 'idUnidadeGeografica' => $model->getIdUnidadeGeografica0()->one()->idUnidadeGeografica,]) : '<span class="label label-warning">?</span>'),
],
			'coordenadaGeografica',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'idColeta' => $model->idColeta],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('ColetaItems'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Coleta Items',
            ['coleta-item/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Coleta Item',
            ['coleta-item/create', 'ColetaItem'=>['idColeta'=>$model->idColeta]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-ColetaItems','linkSelector'=>'#pjax-ColetaItems ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetaItems(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idColetaItem',
// generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "idEspecie",
            "value" => function($model){
                if ($rel = $model->getIdEspecie0()->one()) {
                    return yii\helpers\Html::a($rel->label,["especie/view", 'idEspecie' => $rel->idEspecie,],["data-pjax"=>0]);
                } else {
                    return '';
                }
            },
            "format" => "raw",
],
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'coleta-item' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'coleta-item'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('IdPesquisadors'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Id Pesquisadors',
            ['pesquisador/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Id Pesquisador',
            ['pesquisador/create', 'IdPesquisador'=>['idPesquisador'=>$model->idColeta]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Id Pesquisador', ['coleta-has-pesquisador/create', 'ColetaHasPesquisador'=>['idColeta'=>$model->idColeta]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-IdPesquisadors','linkSelector'=>'#pjax-IdPesquisadors ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetaHasPesquisadors(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idPesquisador',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {delete}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'coleta-has-pesquisador' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                    'class' => 'text-danger',
                    'title' => Yii::t('yii', 'Remove'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete the related item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
            },
'view' => function ($url, $model) {
                return Html::a(
                    '<span class="glyphicon glyphicon-cog"></span>',
                    $url,
                    [
                        'data-title'  => Yii::t('yii', 'View Pivot Record'),
                        'data-toggle' => 'tooltip',
                        'data-pjax'   => '0',
                        'class'        => 'text-muted'
                    ]
                );
            },
    ],
    'controller' => 'coleta-has-pesquisador'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?=
    \yii\bootstrap\Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Coleta',
    'content' => $this->blocks['app\models\Coleta'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Coleta Items</small>',
    'content' => $this->blocks['ColetaItems'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Id Pesquisadors</small>',
    'content' => $this->blocks['IdPesquisadors'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
