<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\PesquisadorSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="pesquisador-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idPesquisador') ?>

		<?= $form->field($model, 'Nome') ?>

		<?= $form->field($model, 'email') ?>

		<?= $form->field($model, 'lattes') ?>

		<?= $form->field($model, 'login') ?>

		<?php // echo $form->field($model, 'senha') ?>

		<?php // echo $form->field($model, 'foto') ?>

		<?php // echo $form->field($model, 'Resumo') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
