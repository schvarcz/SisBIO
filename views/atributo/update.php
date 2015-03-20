<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Atributo $model
 */

$this->title = 'Atributo Update ' . $model->idAtributo . '';
$this->params['breadcrumbs'][] = ['label' => 'Atributos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->idAtributo, 'url' => ['view', 'idAtributo' => $model->idAtributo]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="atributo-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'idAtributo' => $model->idAtributo], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
