<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Metodo $model
 */
$this->title = 'Editar Método: ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Métodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idMetodo' => $model->idMetodo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="metodo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idMetodo' => $model->idMetodo], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
