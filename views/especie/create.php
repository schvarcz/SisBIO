<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Especie $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especie-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
