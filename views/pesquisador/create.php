<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Pesquisador $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesquisador-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
