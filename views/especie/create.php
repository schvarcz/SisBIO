<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Especie $model
 */
$this->title = 'Nova';
$this->params['breadcrumbs'][] = ['label' => 'Espécies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especie-create">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
