<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\TipoDado $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Dados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-dado-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
