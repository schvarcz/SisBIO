<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Familia $model
*/

$this->title = 'Nova';
$this->params['breadcrumbs'][] = ['label' => 'Familias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familia-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
