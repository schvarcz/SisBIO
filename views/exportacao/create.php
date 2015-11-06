<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\Exportacao $model
 */
$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Exportacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacao-create">

    
    <?php echo $this->render('_search', ['model' =>$searchModel]); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'idColeta',
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
            // generated by schmunk42\giiant\crud\providers\RelationProvider::columnFormat
            [
                "class" => yii\grid\DataColumn::className(),
                "attribute" => "idPesquisadorRegistro",
                "value" => function($model)
                {
                    if ($rel = $model->getIdPesquisadorRegistro0()->one())
                    {
                        return yii\helpers\Html::a($rel->label, ["pesquisador/view", 'idPesquisador' => $rel->idPesquisador,], ["data-pjax" => 0]);
                    } else
                    {
                        return '';
                    }
                },
                        "format" => "raw",
            ],
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
