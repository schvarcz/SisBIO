<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TipoAtributo $model
 */

$this->title = 'Tipo Atributo Update ' . $model->idTipoAtributo . '';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Atributos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idTipoAtributo, 'url' => ['view', 'idTipoAtributo' => $model->idTipoAtributo]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="tipo-atributo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idTipoAtributo' => $model->idTipoAtributo], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
