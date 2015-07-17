<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;

GrowlAsset::register($this);
AnimateAsset::register($this);

/**
 * @var yii\web\View $this
 * @var app\models\Pesquisador $model
 */
$this->title = 'Pesquisador ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idPesquisador' => $model->idPesquisador]];
$this->params['breadcrumbs'][] = 'Detalhes';
$url = yii\helpers\Url::to(['invite-reset', 'idPesquisador' => $model->idPesquisador]);
$js = <<<eof
$.ajax({
    url: "$url",
    success:function(data){
        $.notify({
            message: 'Email enviado com sucesso!'
        },{
            type: 'success',
            offset:{y:70,x:20},
            z_index:1029
        });
    }
});
eof;
?>
<div class="pesquisador-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'idPesquisador' => $model->idPesquisador], ['class' => 'btn btn-info'])
        ?>
        <?php
        if ($model->senha == null)
            echo Html::a('<span class="glyphicon glyphicon-certificate"></span> Enviar convite ao sistema', ['invite-reset', 'idPesquisador' => $model->idPesquisador], ['class' => 'btn btn-info', 'onclick' => $js]);
        else
            echo Html::a('<span class="glyphicon glyphicon-certificate"></span> Resetar senha', null, ['onclick' => $js, 'class' => 'btn btn-info']);
        ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Pesquisador', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> Lista', ['index'], ['class' => 'btn btn-default']) ?>
    </p><div class='clearfix'></div> 


    <h3>
        <?= $model->label ?>    </h3>


    <?php $this->beginBlock('app\models\Pesquisador'); ?>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'foto',
            'idPesquisador',
            'Nome',
            'email:email',
            'lattes',
            'Resumo:ntext',
        ],
    ]);
    ?>

    <hr/>

    <?php
    echo Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', ['delete', 'idPesquisador' => $model->idPesquisador], [
        'class' => 'btn btn-danger',
        'data-confirm' => Yii::t('app', 'Tem certeza que quer deletar esse item?'),
        'data-method' => 'post',
    ]);
    ?>

    <?php $this->endBlock(); ?>



    <?php $this->beginBlock('IdColetas'); ?>
    <p class='pull-right'>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-list"></span> Listar todas coletas', ['coleta/index'], ['class' => 'btn text-muted btn-xs']
        )
        ?>
        <?=
        \yii\helpers\Html::a(
                '<span class="glyphicon glyphicon-plus"></span> Nova Coleta', ['coleta/create', 'IdColeta' => ['idColeta' => $model->idPesquisador]], ['class' => 'btn btn-success btn-xs']
        )
        ?>
    </p><div class='clearfix'></div>
    <?php Pjax::begin(['id' => 'pjax-IdColetas', 'linkSelector' => '#pjax-IdColetas ul.pagination a']) ?>
    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getColetaHasPesquisadors(), 'pagination' => ['pageSize' => 10]]),
        'columns' => [ 'idColeta',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'contentOptions' => ['nowrap' => 'nowrap'],
                'urlCreator' => function($action, $model, $key, $index)
        {
            // using the column name as key, not mapping to 'id' like the standard generator
            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
            $params[0] = 'coleta-has-pesquisador' . '/' . $action;
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
                        'controller' => 'coleta-has-pesquisador'
                    ],]
            ]);
            ?>
            <?php Pjax::end() ?>
            <?php $this->endBlock() ?>


            <?php $this->beginBlock('IdProjetos'); ?>
            <p class='pull-right'>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-list"></span> Listar todos projetos', ['projeto/index'], ['class' => 'btn text-muted btn-xs']
                )
                ?>
                <?=
                \yii\helpers\Html::a(
                        '<span class="glyphicon glyphicon-plus"></span> Novo Projeto', ['projeto/create', 'IdProjeto' => ['idProjeto' => $model->idPesquisador]], ['class' => 'btn btn-success btn-xs']
                )
                ?>
            </p><div class='clearfix'></div>
            <?php Pjax::begin(['id' => 'pjax-IdProjetos', 'linkSelector' => '#pjax-IdProjetos ul.pagination a']) ?>
            <?=
            \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getPesquisadorHasProjetos(), 'pagination' => ['pageSize' => 10]]),
                'columns' => [ 'idProjeto0.idProjeto',
                    'idProjeto0.Nome',
                    'idProjeto0.Data_Inicio',
                    'idProjeto0.Data_Fim',
                    [
                        "attribute" => "idProjeto0.ativo",
                        "value" => function($model, $key, $index, $column)
                        {
                            return $key ? "Sim" : "Não";
                        }
                    ],
                    'idProjeto0.Descricao:ntext',
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


                    <?php $this->beginBlock('Projetos'); ?>
                    <p class='pull-right'>
                        <?=
                        \yii\helpers\Html::a(
                                '<span class="glyphicon glyphicon-list"></span> Listar todos projetos', ['projeto/index'], ['class' => 'btn text-muted btn-xs']
                        )
                        ?>
                        <?=
                        \yii\helpers\Html::a(
                                '<span class="glyphicon glyphicon-plus"></span> Novo Projeto', ['projeto/create', 'Projeto' => ['idPesquisadorResponsavel' => $model->idPesquisador]], ['class' => 'btn btn-success btn-xs']
                        )
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
                                "value" => function($model, $key, $index, $column)
                                {
                                    return $key ? "Sim" : "Não";
                                }
                            ],
                            'Descricao:ntext',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update}',
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
                                '<span class="glyphicon glyphicon-plus"></span> Nova Unidade Geográfica', ['unidade-geografica/create', 'UnidadeGeografica' => ['idPesquisador' => $model->idPesquisador]], ['class' => 'btn btn-success btn-xs']
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
                                                        'label' => '<span class="glyphicon glyphicon-asterisk"></span> Pesquisador',
                                                        'content' => $this->blocks['app\models\Pesquisador'],
                                                        'active' => true,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Coletas realizadas </small>',
                                                        'content' => $this->blocks['IdColetas'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Projetos responsáveis </small>',
                                                        'content' => $this->blocks['Projetos'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Projetos envolvido </small>',
                                                        'content' => $this->blocks['IdProjetos'],
                                                        'active' => false,
                                                    ], [
                                                        'label' => '<small><span class="glyphicon glyphicon-paperclip"></span> Unidades geográficas cadastradas</small>',
                                                        'content' => $this->blocks['UnidadeGeograficas'],
                                                        'active' => false,
                                                    ],]
                                            ]
                                    );
                                    ?></div>
