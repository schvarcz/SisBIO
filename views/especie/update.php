<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Especie $model
 */
$this->title = 'Editar Espécie ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Espécies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->label, 'url' => ['view', 'idEspecie' => $model->idEspecie]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="especie-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idEspecie' => $model->idEspecie], ['class' => 'btn btn-info']) ?>
    </p>

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
