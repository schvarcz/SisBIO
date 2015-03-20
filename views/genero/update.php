<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Genero $model
 */

$this->title = 'Genero Update ' . $model->idGenero . '';
$this->params['breadcrumbs'][] = ['label' => 'Generos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idGenero, 'url' => ['view', 'idGenero' => $model->idGenero]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="genero-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idGenero' => $model->idGenero], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
