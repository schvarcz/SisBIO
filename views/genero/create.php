<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Genero $model
 */
$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Gêneros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genero-create">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
