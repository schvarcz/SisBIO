<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\PesquisadorSearch $searchModel
*/

$this->title = 'Pesquisadors';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pesquisador-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Pesquisador', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                                                                                                                                                                                                
            <?php 
            echo \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> Relations',
                    'dropdown' => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => [
    [
        'label' => '<i class="glyphicon glyphicon-random"> Coleta Has Pesquisador</i>',
        'url' => [
            'coleta-has-pesquisador/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Coleta</i>',
        'url' => [
            'coleta/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-random"> Pesquisador Has Projeto</i>',
        'url' => [
            'pesquisador-has-projeto/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Projeto</i>',
        'url' => [
            'projeto/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Projeto</i>',
        'url' => [
            'projeto/index',
        ],
    ],
    [
        'label' => '<i class="glyphicon glyphicon-arrow-right"> Unidade Geografica</i>',
        'url' => [
            'unidade-geografica/index',
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
        
			'idPesquisador',
			'Nome',
			'email:email',
			'lattes',
			'login',
			'senha',
			'foto',
			/*'Resumo:ntext'*/
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
