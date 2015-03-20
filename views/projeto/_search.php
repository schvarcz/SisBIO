<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ProjetoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="projeto-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'idProjeto') ?>

		<?= $form->field($model, 'Nome') ?>

		<?= $form->field($model, 'Data_Inicio') ?>

		<?= $form->field($model, 'Data_Fim') ?>

		<?= $form->field($model, 'ativo') ?>

		<?php // echo $form->field($model, 'idPesquisadorResponsavel') ?>

		<?php // echo $form->field($model, 'Descricao') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
