<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Ordem $model
 */

$this->title = 'Ordem Update ' . $model->idOrdem . '';
$this->params['breadcrumbs'][] = ['label' => 'Ordems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idOrdem, 'url' => ['view', 'idOrdem' => $model->idOrdem]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="ordem-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idOrdem' => $model->idOrdem], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
