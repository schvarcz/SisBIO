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

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?php
            // Multiple file/image selection with image only preview
            // Note for multiple file upload, the attribute name must be appended with 
            // `[]` for PHP to be able to read an array of files
            echo $form->field($model, 'foto')->widget(FileInput::classname(), [
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
            <?= $form->field($model, 'foto')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'lattes')->textInput(['maxlength' => 255]) ?>
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

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Salvar', ['class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary'])
        ?>
        <?php
            if ($model->senha == null)
                echo Html::submitButton('<span class="glyphicon glyphicon-check"></span> Salvar e enviar convite ao sistema', ['class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary', "name"=>"invite"])
        ?>

        <?= Html::a('Cancelar', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
<?php ActiveForm::end(); ?>

    </div>

</div>
