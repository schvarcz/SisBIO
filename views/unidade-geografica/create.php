<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\UnidadeGeografica $model
*/

$this->title = 'Novo';
$this->params['breadcrumbs'][] = ['label' => 'Unidades Geográficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidade-geografica-create">

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
