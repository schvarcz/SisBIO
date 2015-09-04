<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\EspecieSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="especie-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'idEspecie') ?>

    <?= $form->field($model, 'NomeCientifico') ?>

    <?= $form->field($model, 'NomeComum') ?>

    <?= $form->field($model, 'Autor') ?>

    <?= $form->field($model, 'Descricao') ?>

    <?php // echo $form->field($model, 'idGenero') ?>

    <?php // echo $form->field($model, 'idTipo_Organismo')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
