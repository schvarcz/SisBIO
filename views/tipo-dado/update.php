<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoDado $model
 */
$this->title = 'Editar Tipo de Dado ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Dado', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idTipoDado' => $model->idTipoDado]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-dado-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idTipoDado' => $model->idTipoDado], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
