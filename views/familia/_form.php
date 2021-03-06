<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Familia $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="familia-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'NomeCientifico')->textInput(['maxlength' => 255]) ?>
            <?=
            // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
            $form->field($model, 'idOrdem')->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\Ordem::find()->all(), 'idOrdem', 'label'), ['prompt' => 'Choose...']
            );
            ?>
            <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Família',
                            'content' => $this->blocks['main'],
                            'active' => true,
                        ],]
                ]
        );
        ?>
        <hr/>

        <?=
        Html::submitButton('<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord ? 'Criar' : 'Salvar'), ['class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary'])
        ?>

        <?= Html::a('Cancelar', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>
