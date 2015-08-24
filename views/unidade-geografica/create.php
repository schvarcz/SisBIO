<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\UnidadeGeografica $model
 */
$this->title = 'Nova Unidade Geográfica';
$this->params['breadcrumbs'][] = ['label' => 'Unidades Geográficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidade-geografica-create">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
