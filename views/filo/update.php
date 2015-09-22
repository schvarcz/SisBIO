<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Filo $model
 */
$this->title = 'Editar Filo ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Filos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idFilo' => $model->idFilo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="filo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idFilo' => $model->idFilo], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
