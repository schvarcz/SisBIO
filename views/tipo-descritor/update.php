<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoDescritor $model
 */
$this->title = 'Tipo de Descritor: ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Descritor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idTipoDescritor' => $model->idTipoDescritor]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-descritor-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idTipoDescritor' => $model->idTipoDescritor], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
