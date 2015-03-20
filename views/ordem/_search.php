<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\OrdemSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="ordem-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idOrdem') ?>

		<?= $form->field($model, 'NomeCientifico') ?>

		<?= $form->field($model, 'NomeComum') ?>

		<?= $form->field($model, 'Descricao') ?>

		<?= $form->field($model, 'idFilo') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
