<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\NaoIdentificadoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="nao-identificado-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'idNaoIdentificado') ?>

    <?= $form->field($model, 'idTipoOrganismo') ?>

    <?= $form->field($model, 'idPesquisadorIdentificacao') ?>

    <?= $form->field($model, 'Data_Registro') ?>

    <?= $form->field($model, 'Data_Identificacao') ?>

    <?php // echo $form->field($model, 'MorfoEspecie') ?>

    <?php // echo $form->field($model, 'idFilo') ?>

    <?php // echo $form->field($model, 'idOrdem') ?>

    <?php // echo $form->field($model, 'idFamilia') ?>

    <?php // echo $form->field($model, 'idGenero') ?>

    <?php // echo $form->field($model, 'idEspecie')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
