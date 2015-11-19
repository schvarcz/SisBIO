<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Collapse;

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
                'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-7',
                    ],
                ],
    ]);
    ?>
    
    <?=
    $form->field($model, 'idProjeto')->widget(\app\widgets\Select2Active\Select2Active::className(), [
        'options' => ['placeholder' => 'Projeto' , "class" => "col-sm-7"],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => yii\helpers\Url::to(["projeto/findprojeto"]),
                'dataType' => 'json',
                'data' => new JsExpression('function(term,page) { return {nomeProjeto:term.term}; }'),
                'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
            ],
            'initSelection' => true
        ]
    ]);
    ?>
    
    <div class="form-group">
        <label class="control-label col-sm-3">Unidade Geográfica</label>
        <div class="col-sm-7">
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
        <div class = "col-sm-4 col-sm-offset-2">
            <?php
            Modal::begin([
                'header' => '<h2>Atributos da população</h2>',
                'toggleButton' => ['label' => '<div>Atributos da funcionais que serão exportados.</div>', 'tag' => 'a'],
                'footer' => Button::widget([
                    'label' => 'Atualizar',
                    'options' => [
                        'class' => 'btn-primary updateFields',
                        'data-dismiss' => 'modal'
                    ]
                ]),
                'options' => [
                    "class" => "modalColetaPopulacao"
                ],
            ]);
            echo Html::tag("h5", "Selecionar todos os atributos que irá informar. ");
            
            $items = [];
            $organismos = \app\models\TipoOrganismo::find()->all();
            foreach ($organismos as $organismo)
            {
                $models = $organismo->getIdDescritores()->andWhere(["idTipoDescritor" => 1,])->all();
                $items[] = [
                    "label" => $organismo->label,
                    "content" => $this->render('_descritores', ['models' => $models, "organismo" => $organismo]),
                ];
            }

            echo Collapse::widget([
                'items' => $items
            ]);
            Modal::end();
            ?>
        </div>
        <div class = "col-sm-4">
            <?php
            Modal::begin([
                'header' => '<h2>Atributos da população</h2>',
                'toggleButton' => ['label' => '<div>Atributos da população que serão exportados.</div>', 'tag' => 'a'],
                'footer' => Button::widget([
                    'label' => 'Atualizar',
                    'options' => [
                        'class' => 'btn-primary updateFields',
                        'data-dismiss' => 'modal'
                    ]
                ]),
                'options' => [
                    "class" => "modalColetaPopulacao"
                ],
            ]);
            echo Html::tag("h5", "Selecionar todos os atributos que irá informar. ");
            
            $items = [];
            $organismos = \app\models\TipoOrganismo::find()->all();
            foreach ($organismos as $organismo)
            {
                $models = $organismo->getIdDescritores()->andWhere(["idTipoDescritor" => 2,])->all();
                $items[] = [
                    "label" => $organismo->label,
                    "content" => $this->render('_descritores', ['models' => $models, "organismo" => $organismo]),
                ];
            }

            echo Collapse::widget([
                'items' => $items
            ]);
            Modal::end();
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Exportar', ['class' => 'btn btn-primary', 'name'=>'export']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
