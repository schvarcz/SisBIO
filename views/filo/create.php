<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Filo $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Filos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filo-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
