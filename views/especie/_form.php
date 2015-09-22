<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Especie $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="especie-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'NomeComum')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'NomeCientifico')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'Autor')->textInput(['maxlength' => 255]) ?>
            <?=
            // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
            $form->field($model, 'idGenero')->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\Genero::find()->all(), 'idGenero', 'label'), ['prompt' => 'Choose...']
            );
            ?>
            <?=
            // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
            $form->field($model, 'idTipo_Organismo')->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\TipoOrganismo::find()->all(), 'idTipoOrganismo', 'label'), ['prompt' => 'Choose...']
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
                            'label' => 'Espécie',
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
