<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\NaoIdentificado $model
*/

$this->title = 'Nova espécime não identificada';
$this->params['breadcrumbs'][] = ['label' => 'Não Identificados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nao-identificado-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
