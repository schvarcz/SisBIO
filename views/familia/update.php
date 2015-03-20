<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Familia $model
 */

$this->title = 'Familia Update ' . $model->idFamilia . '';
$this->params['breadcrumbs'][] = ['label' => 'Familias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idFamilia, 'url' => ['view', 'idFamilia' => $model->idFamilia]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="familia-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idFamilia' => $model->idFamilia], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
