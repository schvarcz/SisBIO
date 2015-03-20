<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Especie $model
 */

$this->title = 'Especie Update ' . $model->idEspecie . '';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idEspecie, 'url' => ['view', 'idEspecie' => $model->idEspecie]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="especie-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idEspecie' => $model->idEspecie], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
