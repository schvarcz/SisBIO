<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 */
$this->title = 'Novo '.($model->idProjetoPai0?' Subprojeto de '.$model->idProjetoPai0->label:'Projeto');
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projeto-create">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
