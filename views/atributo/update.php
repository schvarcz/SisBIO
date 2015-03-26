<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Atributo $model
 */

$this->title = 'Editar Atributo ' . $model->label . '';
$this->params['breadcrumbs'][] = ['label' => 'Atributos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->label, 'url' => ['view', 'idAtributo' => $model->idAtributo]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="atributo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Detalhes', ['view', 'idAtributo' => $model->idAtributo], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
