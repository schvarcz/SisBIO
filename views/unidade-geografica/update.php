<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\UnidadeGeografica $model
 */

$this->title = 'Unidade Geografica Update ' . $model->idUnidadeGeografica . '';
$this->params['breadcrumbs'][] = ['label' => 'Unidade Geograficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idUnidadeGeografica, 'url' => ['view', 'idUnidadeGeografica' => $model->idUnidadeGeografica]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="unidade-geografica-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idUnidadeGeografica' => $model->idUnidadeGeografica], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
