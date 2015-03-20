<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoDado $model
 */

$this->title = 'Tipo Dado Update ' . $model->idTipoDado . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Dados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idTipoDado, 'url' => ['view', 'idTipoDado' => $model->idTipoDado]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="tipo-dado-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idTipoDado' => $model->idTipoDado], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
