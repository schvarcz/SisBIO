<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Ordem $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Ordems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ordem-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
