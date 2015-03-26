<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\TipoOrganismo $model
*/

$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Organismo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-organismo-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
