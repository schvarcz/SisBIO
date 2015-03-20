<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\TipoAtributoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="tipo-atributo-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idTipoAtributo') ?>

		<?= $form->field($model, 'Tipo') ?>

		<?= $form->field($model, 'Descricao') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
