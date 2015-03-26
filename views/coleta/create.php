<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Coleta $model
*/

$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Coletas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coleta-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
