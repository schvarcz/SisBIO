<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 */

$this->title = 'Projeto Update ' . $model->idProjeto . '';
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idProjeto, 'url' => ['view', 'idProjeto' => $model->idProjeto]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="projeto-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idProjeto' => $model->idProjeto], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
