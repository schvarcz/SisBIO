<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="projeto-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'Nome')->textInput(['maxlength' => 255]) ?>
            <?=
            $form->field($model, 'idPesquisadorResponsavel')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
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
            $form->field($model, 'idPesquisadores')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
                'options' => [
                    "multiple" => true
                ],
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
            $form->field($model, 'Data_Inicio')->widget(\app\widgets\DateTime\DateTimePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'Data_Fim')->widget(\app\widgets\DateTime\DateTimePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            ?>
            <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'ativo')->checkbox() ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Projeto',
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
