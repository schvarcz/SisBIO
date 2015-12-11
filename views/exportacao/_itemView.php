<?php
use yii\helpers\Html;
use app\widgets\ExportingLoadbar\ExportingLoadbar;
?>
<div class="row center-block">
    
    <div class="col-sm-10 col-sm-offset-1">
        <label>Data de Exportação: </label> <?= $model->timestamp ?>
    </div>
    <div class="col-sm-9  col-sm-offset-1">
        <?= ExportingLoadbar::widget(["model"=>$model]) ?>
    </div>
    <div class="col-sm-1">
        <?php
            echo Html::a('<span class="glyphicon glyphicon-eye-open"></span> ', ['view', 'idExportacao' => $model->idExportacao]) ;
            echo Html::a('<span class="glyphicon glyphicon-file"></span> ', [$model->file]) ;
            echo Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['delete', 'idExportacao' => $model->idExportacao]) ;
        ?>
    </div>
</div>