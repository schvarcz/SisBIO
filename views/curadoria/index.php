<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Descritor $model
 */
$this->title = 'Curadoria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="descritor-create">

    <?php
        echo $this->render('_form');
    ?>

</div>
