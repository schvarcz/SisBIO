<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Ordem $model
 */
$this->title = 'Editar Ordem ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Ordems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idOrdem' => $model->idOrdem]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="ordem-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idOrdem' => $model->idOrdem], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
