<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\Pesquisador $model
*/

$this->title = 'Pesquisador View ' . $model->idPesquisador . '';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idPesquisador' => $model->idPesquisador]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="pesquisador-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'idPesquisador' => $model->idPesquisador],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Pesquisador', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Pesquisador'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'idPesquisador',
			'Nome',
			'email:email',
			'lattes',
			'login',
			'senha',
			'foto',
			'Resumo:ntext',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'idPesquisador' => $model->idPesquisador],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('IdColetas'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Id Coletas',
            ['coleta/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Id Coleta',
            ['coleta/create', 'IdColeta'=>['idColeta'=>$model->idPesquisador]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Id Coleta', ['coleta-has-pesquisador/create', 'ColetaHasPesquisador'=>['idPesquisador'=>$model->idPesquisador]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-IdColetas','linkSelector'=>'#pjax-IdColetas ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetaHasPesquisadors(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idColeta',
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


<?php $this->beginBlock('IdProjetos'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Id Projetos',
            ['projeto/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Id Projeto',
            ['projeto/create', 'IdProjeto'=>['idProjeto'=>$model->idPesquisador]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-link"></span> Attach Id Projeto', ['pesquisador-has-projeto/create', 'PesquisadorHasProjeto'=>['idPesquisador'=>$model->idPesquisador]],
            ['class'=>'btn btn-info btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-IdProjetos','linkSelector'=>'#pjax-IdProjetos ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPesquisadorHasProjetos(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idProjeto',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {delete}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'pesquisador-has-projeto' . '/' . $action;
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
    'controller' => 'pesquisador-has-projeto'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('Projetos'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Projetos',
            ['projeto/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Projeto',
            ['projeto/create', 'Projeto'=>['idPesquisadorResponsavel'=>$model->idPesquisador]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-Projetos','linkSelector'=>'#pjax-Projetos ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getProjetos(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idProjeto',
			'Nome',
			'Data_Inicio',
			'Data_Fim',
			'ativo',
			'Descricao:ntext',
[
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = 'projeto' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'projeto'
],]
]);?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('UnidadeGeograficas'); ?>
<p class='pull-right'>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-list"></span> List All Unidade Geograficas',
            ['unidade-geografica/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= \yii\helpers\Html::a(
            '<span class="glyphicon glyphicon-plus"></span> New Unidade Geografica',
            ['unidade-geografica/create', 'UnidadeGeografica'=>['idPesquisador'=>$model->idPesquisador]],
            ['class'=>'btn btn-success btn-xs']
        ) ?>
</p><div class='clearfix'></div>
<?php Pjax::begin(['id'=>'pjax-UnidadeGeograficas','linkSelector'=>'#pjax-UnidadeGeograficas ul.pagination a']) ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getUnidadeGeograficas(), 'pagination' => ['pageSize' => 10]]),
    'columns' => [			'idUnidadeGeografica',
			'Nome',
			'shape',
			'Data_Criacao',
// generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "idProjeto",
            "value" => function($model){
                if ($rel = $model->getIdProjeto0()->one()) {
                    return yii\helpers\Html::a($rel->label,["projeto/view", 'idProjeto' => $rel->idProjeto,],["data-pjax"=>0]);
                } else {
                    return '';
                }
            },
            "format" => "raw",
],
// generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "idUnidadeGeograficaPai",
            "value" => function($model){
                if ($rel = $model->getIdUnidadeGeograficaPai0()->one()) {
                    return yii\helpers\Html::a($rel->label,["unidade-geografica/view", 'idUnidadeGeografica' => $rel->idUnidadeGeografica,],["data-pjax"=>0]);
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
        $params[0] = 'unidade-geografica' . '/' . $action;
        return \yii\helpers\Url::toRoute($params);
    },
    'buttons'    => [
        
    ],
    'controller' => 'unidade-geografica'
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Pesquisador',
    'content' => $this->blocks['app\models\Pesquisador'],
    'active'  => true,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Id Coletas</small>',
    'content' => $this->blocks['IdColetas'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Id Projetos</small>',
    'content' => $this->blocks['IdProjetos'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Projetos</small>',
    'content' => $this->blocks['Projetos'],
    'active'  => false,
],[
    'label'   => '<small><span class="glyphicon glyphicon-paperclip"></span> Unidade Geograficas</small>',
    'content' => $this->blocks['UnidadeGeograficas'],
    'active'  => false,
], ]
                 ]
    );
    ?></div>
