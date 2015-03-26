<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\UnidadeGeografica $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="unidade-geografica-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
			<?= $form->field($model, 'shape')->textInput() ?>
			<?= // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
$form->field($model, 'idProjeto')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\Projeto::find()->all(),'idProjeto','label'),
    ['prompt'=>'Choose...']
); ?>
			<?= // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
$form->field($model, 'idPesquisador')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\Pesquisador::find()->all(),'idPesquisador','label'),
    ['prompt'=>'Choose...']
); ?>
			<?= $form->field($model, 'Data_Criacao')->widget(\zhuravljov\widgets\DateTimePicker::className(), [
    'options' => ['class' => 'form-control'],
    'clientOptions' => [
        'autoclose' => true,
        'todayHighlight' => true,
    ],
]) ?>
			<?= // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
$form->field($model, 'idUnidadeGeograficaPai')->dropDownList(
    \yii\helpers\ArrayHelper::map(app\models\UnidadeGeografica::find()->all(),'idUnidadeGeografica','label'),
    ['prompt'=>'Choose...']
); ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'UnidadeGeografica',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Criar' : 'Salvar'), ['class' => $model->isNewRecord ?
        'btn btn-primary' : 'btn btn-primary']) ?>

        <?= Html::a('Cancelar', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>
