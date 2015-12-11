<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExportacaoSearch $searchModel
 */
$this->title = 'Exportação';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="exportacao-index">


    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nova Exportação', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        "itemView" => "_itemView"
    ]);
    ?>

</div>
