<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\NaoIdentificado $model
 */
$this->title = 'Não Identificado Editar: ' . $model->getLabel() . '';
$this->params['breadcrumbs'][] = ['label' => 'Não Identificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getLabel(), 'url' => ['view', 'idNaoIdentificado' => $model->idNaoIdentificado]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="nao-identificado-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idNaoIdentificado' => $model->idNaoIdentificado], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
