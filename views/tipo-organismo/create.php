<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\TipoOrganismo $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Organismos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-organismo-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
