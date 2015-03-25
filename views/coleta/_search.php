<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ColetaSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="coleta-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idColeta') ?>

		<?= $form->field($model, 'Data_Coleta') ?>

		<?= $form->field($model, 'Observacao') ?>

		<?= $form->field($model, 'idUnidadeGeografica') ?>

		<?= $form->field($model, 'coordenadaGeografica') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
