<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoOrganismo $model
 */

$this->title = 'Editar Tipo de Organismo: ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Organismo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idTipoOrganismo' => $model->idTipoOrganismo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="tipo-organismo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idTipoOrganismo' => $model->idTipoOrganismo], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
