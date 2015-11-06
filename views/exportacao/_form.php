<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var app\models\Exportacao $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="exportacao-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <div class="form-group">
                <label class="control-label col-sm-3">Projeto</label>
                <div class = "col-sm-7">
                <?=
                \app\widgets\Select2Active\Select2Active::widget([
                    'id' => 'projeto',
                    'name' => 'projeto',
                    'options' => ['placeholder' => 'Projeto da coleta'],
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
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Unidade Geográfica</label>
                <div class="col-sm-7">
                <?=
                \app\widgets\Select2Active\Select2Active::widget([
                    'name' => 'unidade-geografica',
                    'options' => [
                        'placeholder' => 'Nome da unidade geográfica'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["unidade-geografica/findugbyprojeto"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {nomeUnidadeGeografica:term.term,idProjeto: $("#projeto").val()}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ],
                        'initSelection' => true
                    ],
                ]);
                ?>
                    <p style="font-weight: normal; color:#999999"><small><?= Html::checkbox("include-children",true,["label"=> 'Incluir unidades geográficas filhas a esta.']);?> </small></p>
                </div>
            </div>
        

            <div class="form-group">
                <label class="control-label col-sm-3">Intervalo de data</label>
                <div class = "col-sm-3">
                <?=
                \app\widgets\DateTime\DatePicker::widget([
                    'name' => 'data-inicio',
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
                    'name' => 'data-fim',
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

        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Exportacao',
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
