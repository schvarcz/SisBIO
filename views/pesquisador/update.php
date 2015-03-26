<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Pesquisador $model
 */

$this->title = 'Editar Pesquisador ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idPesquisador' => $model->idPesquisador]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="pesquisador-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idPesquisador' => $model->idPesquisador], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
