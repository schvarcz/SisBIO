<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\TipoOrganismo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="tipo-organismo-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'idAtributos')->checkboxList(
                    \yii\helpers\ArrayHelper::map(app\models\Atributo::find()->all(), 'idAtributo', 'label'))
            ?>
        <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Tipo de Organismo',
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
