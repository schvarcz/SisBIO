<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Genero $model
 */

$this->title = 'Editar Gênero ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Gêneros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idGenero' => $model->idGenero]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="genero-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idGenero' => $model->idGenero], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
