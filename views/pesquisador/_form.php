<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\Pesquisador $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="pesquisador-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'Resumo')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'lattes')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'senha')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'foto')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'login')->textInput(['maxlength' => 45]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Pesquisador',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), ['class' => $model->isNewRecord ?
        'btn btn-primary' : 'btn btn-primary']) ?>

        <?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>
