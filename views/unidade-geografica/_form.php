<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;

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

            <?= app\widgets\GMaps\GMaps::widget([ 
                "model" => $model, 
                "attribute" => "shape",
                'options' => ['class' => 'col-sm-12'],
                'clientOptions' => [
                    "editable" => true,
                    "mapsOptions" => [
                        "zoom" => 8,
                        "center" => [-30.0393227, -51.2325482]
                    ]
                ]]); ?>
            <?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
            <?=
            // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
            $form->field($model, 'idProjeto')->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\Projeto::find()->all(), 'idProjeto', 'label'), ['prompt' => 'Choose...']
            );
            ?>
            <?=
            $form->field($model, 'idPesquisador')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'url' => yii\helpers\Url::to(["pesquisador/findpesquisador"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(term,page) { return {pesquisador:term.term}; }'),
                        'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                    ],
                    'initSelection' => true
                ],
            ]);
            ?>
            <?=
            $form->field($model, 'Data_Criacao')->widget(\app\widgets\DateTime\DateTimePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'idUnidadeGeograficaPai')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
                'options' => ['placeholder' => 'Nome da unidade geográfica ao qual está contida...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 1,
                    'ajax' => [
                        'url' => yii\helpers\Url::to(["unidade-geografica/findug"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(term,page) { return {nomeUnidadeGeografica:term.term}; }'),
                        'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                    ],
                    'initSelection' => true
                ],
            ]);
            ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Unidade Geográfica',
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
