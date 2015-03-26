<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Atributo $model
*/

$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Atributos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atributo-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
