<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\Select2;
use app\widgets\PermissaoProjeto\PermissaoProjeto;

/**
 * @var yii\web\View $this
 * @var app\models\Projeto $model
 * @var yii\widgets\ActiveForm $form
 */

$this->registerJsFile(Yii::$app->homeUrl . "js/projeto.js", [ "depends" => ['yii\web\JqueryAsset']]);
?>

<div class="projeto-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= Html::activeHiddenInput($model, 'idProjetoPai') ?>
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
            $form->field($model, 'Data_Inicio')->widget(\app\widgets\DateTime\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            ?>
            <?=
            $form->field($model, 'Data_Fim')->widget(\app\widgets\DateTime\DatePicker::classname(), [
                'options' => ['class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]);
            ?>
            <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'ativo')->checkbox() ?>
        <hr/>
        <div class="form-group">
            <label class="control-label col-sm-3">Nova Permissão</label>
            <div class = "col-sm-6">
                <?=
                Select2::widget([
                    'name' => 'pesquisador_add',
                    'options' => [
                        'placeholder' => 'Selecione um pesquisador',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["pesquisador/findpesquisador"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {pesquisador:term.term};}'), //idTipoOrganismo é uma variável global definida no arquivo web/js/coleta.js
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ]
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                                'class' => 'btn btn-primary plus-permissao',
                                'title' => 'Adiciona pesquisador as permissões personalizadas',
                                'data-toggle' => 'tooltip'
                            ]),
                            'asButton' => true
                        ]
                    ]
                ]);
                ?>
            </div>
            <div class="clearfix"></div>
            <?= PermissaoProjeto::widget(["name" => "projeto-permissao", "model" => $model]); ?>
        </div>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => $model->idProjetoPai0?'Subprojeto de '.$model->idProjetoPai0->label:'Projeto',
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
