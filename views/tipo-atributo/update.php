<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoAtributo $model
 */
$this->title = 'Tipo de Atributo: ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Atributo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idTipoAtributo' => $model->idTipoAtributo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-atributo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idTipoAtributo' => $model->idTipoAtributo], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
