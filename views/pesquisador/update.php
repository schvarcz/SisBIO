<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Pesquisador $model
 */

$this->title = 'Pesquisador Update ' . $model->idPesquisador . '';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idPesquisador, 'url' => ['view', 'idPesquisador' => $model->idPesquisador]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="pesquisador-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idPesquisador' => $model->idPesquisador], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
