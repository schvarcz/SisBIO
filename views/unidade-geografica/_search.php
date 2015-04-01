<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\UnidadeGeograficaSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="unidade-geografica-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'idUnidadeGeografica') ?>

    <?= $form->field($model, 'Nome') ?>

    <?= $form->field($model, 'shape') ?>

    <?= $form->field($model, 'Data_Criacao') ?>

    <?= $form->field($model, 'idProjeto') ?>

    <?php // echo $form->field($model, 'idPesquisador') ?>

    <?php // echo $form->field($model, 'idUnidadeGeograficaPai')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
