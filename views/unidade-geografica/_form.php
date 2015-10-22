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
            $form->field($model, 'idProjeto')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 0,
                    'ajax' => [
                        'url' => yii\helpers\Url::to(["projeto/findprojeto"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(term,page) { return {nomeProjeto:term.term, action:2}; }'),
                        'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                    ],
                    'initSelection' => true
                ],
                'pluginEvents' => [
                    'select2:select' => 'function(e) { $("#unidadegeografica-idunidadegeograficapai").attr("disabled",false).select2("val",""); }',
                ],
            ]);
            ?>
            <?= 
                Html::activeHiddenInput($model,'idPesquisador',['value'=> Yii::$app->user->id]);
            ?>
            <?=
            $form->field($model, 'Data_Coordenadas')->widget(\app\widgets\DateTime\DateTimePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'idUnidadeGeograficaPai')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
                'options' => [
                    'placeholder' => 'Nome da unidade geográfica ao qual está contida...', 
                    "disabled"=>$model->idProjeto==null
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 0,
                    'ajax' => [
                        'url' => yii\helpers\Url::to(["unidade-geografica/findugbyprojeto"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(term,page) { return {nomeUnidadeGeografica:term.term, idProjeto:$("#unidadegeografica-idprojeto").val()}; }'),
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
