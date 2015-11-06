<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var app\models\ExportacaoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="exportacao-search">

    <?php
    $form = ActiveForm::begin(['layout' => 'horizontal',
                'action' => ['create'],
                'method' => 'get',
    ]);
    ?>
    
    <?=
    $form->field($model, 'idProjeto')->widget(\app\widgets\Select2Active\Select2Active::className(), [
        'options' => ['placeholder' => 'Projeto'],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => yii\helpers\Url::to(["projeto/findprojeto"]),
                'dataType' => 'json',
                'data' => new JsExpression('function(term,page) { return {nomeProjeto:term.term}; }'),
                'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
            ],
            'initSelection' => true
        ],
        'pluginEvents' => [
            'select2:select' => 'function(e) { methodsProjeto.select(e); }',
            "select2:unselect" => "function(e) { methodsProjeto.unselect(); }"
        ],
    ]);
    ?>
    
    <div class="form-group">
        <label class="control-label col-sm-3">Unidade Geográfica</label>
        <div class="col-sm-6">
            <?=
            \app\widgets\Select2Active\Select2Active::widget([
                'model' => $model,
                'attribute' => 'idUnidadeGeografica',
                'options' => [
                    'placeholder' => 'Nome da unidade geográfica'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'url' => yii\helpers\Url::to(["unidade-geografica/findugbyprojeto"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(term,page) { return {nomeUnidadeGeografica:term.term,idProjeto: $("#exportacaosearch-idprojeto").val()}; }'),
                        'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                    ],
                    'initSelection' => true
                ],
            ]);
            ?>
            <p style="font-weight: normal; color:#999999"><small><?= Html::checkbox("include-children", true, ["label" => 'Incluir unidades geográficas filhas a esta.']); ?> </small></p>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-3">Intervalo de data</label>
        <div class = "col-sm-3">
            <?=
            \app\widgets\DateTime\DatePicker::widget([
                'model' => $model,
                'attribute' => 'dataInicio',
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            ?>
        </div>
        <label class = "col-sm-1 control-label" style="text-align: center">
            à
        </label>
        <div class = "col-sm-3">
            <?=
            \app\widgets\DateTime\DatePicker::widget([
                'model' => $model,
                'attribute' => 'dataFim',
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Exportar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
