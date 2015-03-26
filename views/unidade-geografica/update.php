<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\UnidadeGeografica $model
 */

$this->title = 'Unidade Geografica Update ' . $model->idUnidadeGeografica . '';
$this->params['breadcrumbs'][] = ['label' => 'Unidades Geográficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idUnidadeGeografica, 'url' => ['view', 'idUnidadeGeografica' => $model->idUnidadeGeografica]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="unidade-geografica-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idUnidadeGeografica' => $model->idUnidadeGeografica], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
