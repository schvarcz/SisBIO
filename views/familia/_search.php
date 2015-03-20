<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\FamiliaSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="familia-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idFamilia') ?>

		<?= $form->field($model, 'NomeCientifico') ?>

		<?= $form->field($model, 'NomeComum') ?>

		<?= $form->field($model, 'Descricao') ?>

		<?= $form->field($model, 'idOrdem') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
