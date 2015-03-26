<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\ColetaSearch $searchModel
*/

$this->title = 'Coletas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="coleta-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Coleta', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                                                                                                                                        
            <?php 
            echo \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> Relacionados',
                    'dropdown' => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => [
    [
        'label' => '<i class="glyphicon glyphicon-arrow-left"> Unidade Geografica</i>',
        'url' => [
            'unidade-geografica/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Coleta Item</i>',
        'url' => [
            'coleta-item/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-random"> Coleta Has Pesquisador</i>',
        'url' => [
            'coleta-has-pesquisador/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Pesquisador</i>',
        'url' => [
            'pesquisador/index',
        ],
    ],
]                    ],
                ]
            );
            ?>        </div>
    </div>

            <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        
			'idColeta',
			'Data_Coleta',
			'Observacao:ntext',
			// generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
[
            "class" => yii\grid\DataColumn::className(),
            "attribute" => "idUnidadeGeografica",
            "value" => function($model){
                if ($rel = $model->getIdUnidadeGeografica0()->one()) {
                    return yii\helpers\Html::a($rel->label,["unidade-geografica/view", 'idUnidadeGeografica' => $rel->idUnidadeGeografica,],["data-pjax"=>0]);
                } else {
                    return '';
                }
            },
            "format" => "raw",
],
			'coordenadaGeografica',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                    return \yii\helpers\Url::toRoute($params);
                },
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ],
    ]); ?>
    
</div>
