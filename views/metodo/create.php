<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Metodo $model
 */
$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Metodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodo-create">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
