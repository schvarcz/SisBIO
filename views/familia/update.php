<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Familia $model
 */
$this->title = 'Editar Família ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Familias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idFamilia' => $model->idFamilia]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="familia-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idFamilia' => $model->idFamilia], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
