<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\TipoAtributo $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Atributos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-atributo-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
