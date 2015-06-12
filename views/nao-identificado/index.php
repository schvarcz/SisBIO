<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\NaoIdentificadoSearch $searchModel
 */
$this->title = 'Não Identificados';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="nao-identificado-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Espécime não identificada', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">



            <?php
            echo \yii\bootstrap\ButtonDropdown::widget(
                    [
                        'id' => 'giiant-relations',
                        'encodeLabel' => false,
                        'label' => '<span class="glyphicon glyphicon-paperclip"></span> Relacionados',
                        'dropdown' => [
                            'options' => [
                                'class' => 'dropdown-menu-right'
                            ],
                            'encodeLabels' => false,
                            'items' => [
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-right"> Coleta Item</i>',
                                    'url' => [
                                        'coleta-item/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Especie</i>',
                                    'url' => [
                                        'especie/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Pesquisador</i>',
                                    'url' => [
                                        'pesquisador/index',
                                    ],
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-arrow-left"> Tipo Organismo</i>',
                                    'url' => [
                                        'tipo-organismo/index',
                                    ],
                                ],
                            ]],
                    ]
            );
            ?>        </div>
    </div>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'idNaoIdentificado',
            // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
            [
                "class" => yii\grid\DataColumn::className(),
                "attribute" => "idTipoOrganismo",
                "value" => function($model) {
                    if ($rel = $model->getIdTipoOrganismo0()->one()) {
                        return yii\helpers\Html::a($rel->label, ["tipo-organismo/view", 'idTipoOrganismo' => $rel->idTipoOrganismo,], ["data-pjax" => 0]);
                    } else {
                        return '';
                    }
                },
                        "format" => "raw",
                    ],
                    // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                    [
                        "class" => yii\grid\DataColumn::className(),
                        "attribute" => "idEspecie",
                        "value" => function($model) {
                            if ($rel = $model->getIdEspecie0()->one()) {
                                return yii\helpers\Html::a($rel->label, ["especie/view", 'idEspecie' => $rel->idEspecie,], ["data-pjax" => 0]);
                            } else {
                                return '';
                            }
                        },
                                "format" => "raw",
                            ],
                            // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
                            [
                                "class" => yii\grid\DataColumn::className(),
                                "attribute" => "idPesquisadorIdentificacao",
                                "value" => function($model) {
                                    if ($rel = $model->getIdPesquisadorIdentificacao0()->one()) {
                                        return yii\helpers\Html::a($rel->label, ["pesquisador/view", 'idPesquisador' => $rel->idPesquisador,], ["data-pjax" => 0]);
                                    } else {
                                        return '';
                                    }
                                },
                                        "format" => "raw",
                                    ],
                                    'Data_Registro',
                                    'Data_Identificacao',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'urlCreator' => function($action, $model, $key, $index) {
                                            // using the column name as key, not mapping to 'id' like the standard generator
                                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                            $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                                            return \yii\helpers\Url::toRoute($params);
                                        },
                                                'contentOptions' => ['nowrap' => 'nowrap']
                                            ],
                                        ],
                                    ]);
                                    ?>

</div>