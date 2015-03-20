<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoOrganismo $model
 */

$this->title = 'Tipo Organismo Update ' . $model->idTipoOrganismo . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Organismos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idTipoOrganismo, 'url' => ['view', 'idTipoOrganismo' => $model->idTipoOrganismo]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="tipo-organismo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idTipoOrganismo' => $model->idTipoOrganismo], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
