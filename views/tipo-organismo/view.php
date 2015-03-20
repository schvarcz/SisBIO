<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\TipoOrganismo $model
*/

$this->title = 'Tipo Organismo View ' . $model->idTipoOrganismo . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Organismos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idTipoOrganismo' => $model->idTipoOrganismo]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="tipo-organismo-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'idTipoOrganismo' => $model->idTipoOrganismo],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Tipo Organismo', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\TipoOrganismo'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'idTipoOrganismo',
			'Nome',
			'Descricao:ntext',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'idTipoOrganismo' => $model->idTipoOrganismo],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('Especies'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Especies',
            ['especie/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Especy',
            ['especie/create', 'Especy'=>['idTipo_Organismo'=>$model->idTipoOrganismo]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Especies','linkSelector'=>'#pjax-Especies ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getEspecies(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idEspecie',
			'NomeCientifico',
			'NomeComum',
			'Descricao:ntext',
// generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "idGenero",
            "value" => function($model){
                if ($rel = $model->getIdGenero0()->one()) {
                    return yii\helpers\Html::a($rel->label,["genero/view", 'idGenero' => $rel->idGenero,],["data-pjax"=>0]);
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
        $params[0] = 'especie' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'especie'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('IdAtributos'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Id Atributos',
            ['atributo/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Id Atributo',
            ['atributo/create', 'IdAtributo'=>['idAtributo'=>$model->idTipoOrganismo]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Id Atributo', ['tipo-organismo-has-atributo/create', 'TipoOrganismoHasAtributo'=>['idTipoOrganismo'=>$model->idTipoOrganismo]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-IdAtributos','linkSelector'=>'#pjax-IdAtributos ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getTipoOrganismoHasAtributos(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idAtributo',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {delete}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'tipo-organismo-has-atributo' . '/' . $action;
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
    'controller' => 'tipo-organismo-has-atributo'
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> TipoOrganismo',
    'content' => $this->blocks['app\models\TipoOrganismo'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Especies</small>',
    'content' => $this->blocks['Especies'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Id Atributos</small>',
    'content' => $this->blocks['IdAtributos'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
