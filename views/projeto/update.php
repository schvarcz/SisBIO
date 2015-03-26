<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 */

$this->title = 'Editar Projeto ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idProjeto' => $model->idProjeto]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="projeto-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idProjeto' => $model->idProjeto], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
