<?php

/**
 * @var yii\web\View $this
 * @var app\models\Exportacao $model
 */
$this->title = 'Exportando';
$this->params['breadcrumbs'][] = ['label' => 'Exportação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<center><h2>Exportando... </h2></center>
<br/>
<br/>
<div class="col-sm-10 col-sm-offset-1">
    <p>Aguarde. Assim que a exportação dos dados terminar, o download de seu arquivo irá começar. </p>
</div>
<br/>
<br/>
<div class="col-sm-10 col-sm-offset-1">
    <?= \app\widgets\ExportingLoadbar\ExportingLoadbar::widget(["model"=>$model]);?>
</div>
