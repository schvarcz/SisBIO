<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExportacaoSearch $searchModel
 */
$this->title = 'Exportacaos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="exportacao-index">


    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Novo Exportacao', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'idExportacao',
            'percent',
            'file',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index)
                {
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
