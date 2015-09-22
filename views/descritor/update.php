<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Descritor $model
 */
$this->title = 'Editar Descritor ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Descritores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idDescritor' => $model->idDescritor]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="descritor-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idDescritor' => $model->idDescritor], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
