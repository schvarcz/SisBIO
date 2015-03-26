<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Coleta $model
 */

$this->title = 'Coleta Update ' . $model->idColeta . '';
$this->params['breadcrumbs'][] = ['label' => 'Coletas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idColeta, 'url' => ['view', 'idColeta' => $model->idColeta]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="coleta-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idColeta' => $model->idColeta], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
