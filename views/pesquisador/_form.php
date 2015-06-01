<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

/**
 * @var yii\web\View $this
 * @var app\models\Pesquisador $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="pesquisador-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false, 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            <?=
            $form->field($model, 'photo')->widget(FileInput::classname(), [
                'options' => [ 'accept' => 'image/*'],
                'pluginOptions' => [
                    'previewFileType' => 'image',
                    'showCaption' => false,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]);
            ?>
            <?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'lattes')->textInput(['maxlength' => 255]) ?>
            <?php
//			<= $form->field($model, 'senha')->textInput(['maxlength' => 255]) >
//			<= $form->field($model, 'login')->textInput(['maxlength' => 45]) >
            ?>
            <?= $form->field($model, 'Resumo')->textarea(['rows' => 6]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Pesquisador',
                            'content' => $this->blocks['main'],
                            'active' => true,
                        ],]
                ]
        );
        ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord ? 'Criar' : 'Salvar'), ['class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary'])
        ?>

        <?= Html::a('Cancelar', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
<?php ActiveForm::end(); ?>

    </div>

</div>
